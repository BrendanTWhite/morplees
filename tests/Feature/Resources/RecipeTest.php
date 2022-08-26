<?php

use function Pest\Livewire\livewire;
use App\Filament\Resources\RecipeResource;
use App\Models\Recipe;

beforeEach(function () {
    global $user, $shop;
    $user = App\Models\User::factory()->create();
    $shop = App\Models\Shop::factory(['family_id' => $user->family_id])->create();
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
});

// Test can see index URL on home page

it('can see index URL on home page', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee(RecipeResource::getUrl('index'));
});

// Test Action 'index' with GET at route '/recipes'

it('can render empty Recipes index', function () {
    $this
    ->get(RecipeResource::getUrl('index'))
    ->assertOk()
    ->assertSeeInOrder([
        'Recipes',
        'New recipe',
        'No records found',
    ]);
});

it('can render populated Recipes index', function () {
    global $user, $shop;

    $recipes = Recipe::factory([
            'family_id' => $user->family_id,
        ])
        ->count(10)->create();

    livewire(RecipeResource\Pages\ListRecipes::class)
        ->assertOk()
        ->assertCanSeeTableRecords($recipes)
        ->assertSeeInOrder([
            'Recipes',
            'New recipe',
            'Name',
            'Prep time',
            'Cook time',
            'Book reference',
            'Url',
        ]);
    $this->assertAuthenticated();

});

// Test Action 'create' with GET at route '/recipes/create'

it('can render empty New Recipe form', function () {
    $this
        ->get(RecipeResource::getUrl('create'))
        ->assertOk()
        ->assertSeeInOrder([
            'Create recipe',
            'Name',
            'Select an option',
            // 'Default in list',
            // 'Needed soon',
            'Create',
            'Create & create another',
            'Cancel',
        ]);
    });

// Test Action 'store' with POST at route '/recipes'

it('can create New Recipes', function () {
    global $user, $shop;
    $shop->name = 'My Super Cool Shop';

    $this->post('/recipes', [
        'name' => 'Foo',
        'shop' => $shop->id,
    ])
    ->assertSeeInOrder([
        'View recipe',
        'Edit',
        'Name',
        'Foo', 
    ])
    ->assertSeeInOrder([
        'Shop',
        'My Super Cool Shop',
    ])
    ->assertSeeInOrder([
        // 'Default in list',
        // 'Needed soon',
        // 'Used in',
    ]);
});

it('can create', function () {
    global $user, $shop;

    $recipe = Recipe::factory()->make();
 
    livewire(RecipeResource\Pages\CreateRecipe::class)
        ->fillForm([
            'name'            => $recipe->name,
            'family_id'       => $user->family_id,
            // 'default_in_list' => $recipe->default_in_list,
            // 'needed_soon'     => $recipe->needed_soon,
        ])
        ->call('create')
        ->assertHasNoFormErrors();
 
    $this->assertDatabaseHas(Recipe::class, [
        'name'            => $recipe->name,
        'family_id'       => $user->family_id,
        // 'default_in_list' => $recipe->default_in_list,
        // 'needed_soon'     => $recipe->needed_soon,
    ]);
});


// Test Action 'show' with GET at route '/recipes/[id]'

it('can show a recipe', function(){
    global $user;

    $recipe = Recipe::factory([
        'family_id' => $user->family_id,
        ])->create();

    $this->get('/recipes/'.$recipe->id)
    ->assertSeeInOrder([
        'View Recipe',
        'Edit',
        'Prep time',
        'Cook time',
    ])
    ;
});

// Test Action 'edit' with GET at route '/recipes/[id]/edit'

it('can render the edit route ', function(){
    global $user, $shop;

    $recipe = Recipe::factory([
        'family_id' => $user->family_id,
        ])->create();

    $this->get('/recipes/'.$recipe->id.'/edit')
    ->assertSeeInOrder([
        'Edit Recipe',
        'View',
        'Delete',
        'Save',
        'Cancel',
    ])
    ->assertSeeInOrder([
        $recipe->name,
        $recipe->bookReference,
    ])
    ->assertSeeInOrder([
        'Ingredients',
        'Steps',
    ]);
});

it('can render edit page', function () {
    global $user, $shop;

    $this->get(RecipeResource::getUrl('edit', [
            'record' => Recipe::factory(['family_id'=>$user->family_id])->create(),
        ]))
        ->assertSuccessful();
});


it('can retrieve data', function () {
    global $user, $shop;

    $recipe = Recipe::factory(['family_id'=>$user->family_id])->create();
 
    livewire(RecipeResource\Pages\EditRecipe::class, [
        'record' => $recipe->getKey(),
    ])
        ->assertFormSet([
        'name'           => $recipe->name,
        'prep_time'      => $recipe->prep_time,
        'cook_time'      => $recipe->cook_time,
        'book_reference' => $recipe->book_reference,
        'url'            => $recipe->url,
        ]);
});

// Test Action 'update' with PUT/PATCH at route '/recipes/[id]'

it('can update a recipe', function(){
    global $user, $shop;

    $recipe = Recipe::factory(['family_id'=>$user->family_id])->create();
    $newData = Recipe::factory(['family_id'=>$user->family_id])->make();
 
    livewire(RecipeResource\Pages\EditRecipe::class, [
        'record' => $recipe->getKey(),
    ])
        ->fillForm([
            'name'           => $newData->name,
            'prep_time'      => $newData->prep_time,
            'cook_time'      => $newData->cook_time,
            'book_reference' => $newData->book_reference,
            'url'            => $newData->url,
        ])
        ->call('save')
        ->assertHasNoFormErrors();
 
    expect($recipe->refresh())
        ->family_id      ->toBe($newData->family_id)
        ->name           ->toBe($newData->name)
        ->prep_time      ->toBe((int)$newData->prep_time)
        ->cook_time      ->toBe((int)$newData->cook_time)
        ->book_reference ->toBe($newData->book_reference)
        ->url            ->toBe($newData->url)
        ;
});

// Test Action 'destroy' with DELETE at route '/recipes/[id]'


it('can delete', function () {
    global $user;

    $recipe = Recipe::factory(['family_id'=>$user->family_id])->create();
 
    livewire(RecipeResource\Pages\EditRecipe::class, [
        'record' => $recipe->getKey(),
    ])
        ->callPageAction(Filament\Pages\Actions\DeleteAction::class);
 
    $this->assertModelMissing($recipe);
});

