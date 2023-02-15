# ERD Diagram


## Options
Options for Delete (from [the doco](https://laravel.com/docs/9.x/migrations#foreign-key-constraints))
- cascadeOnDelete
- restrictOnDelete
- nullOnDelete

## cascadeOnDelete
Child records get deleted
eg delete a recipe, the steps and ingredients also vanish

## restrictOnDelete
Can't delete parent
- Family to Anything = restrictOnDelete, but (eventually) offer Redact
- Anything else - explain why the delete failed

## nullOnDelete
Child remains, gets `null` as their parent
Note - parent_id field on child must be `->nullable()`

````mermaid
    erDiagram
        Family   ||--o{ ShoppingList : restrictOnDelete
        ShoppingList ||--o{ SLRecipe : cascadeOnDelete
        ShoppingList ||--o{ SLItem   : cascadeOnDelete
        Family   ||--o{ Recipe       : restrictOnDelete
        Recipe   ||--o{ SLRecipe     : cascadeOnDelete
        SLRecipe |o--o{ SLItem       : nullOnDelete
        Recipe   ||--o{ Ingredient   : cascadeOnDelete
        Recipe   ||--o{ Step         : cascadeOnDelete
        Ingredient |o--o{ SLItem     : nullOnDelete 
        Family   ||--o{ Shop         : restrictOnDelete
        Shop     ||--o{ Product      : restrictOnDelete
        Product  ||--o{ Ingredient   : restrictOnDelete
        Product  ||--o{ SLItem       : restrictOnDelete
        Family   ||--|{ User         : restrictOnDelete
````

*Note* - when a `Recipe` is deleted, any related `SLRecipe`s
should be deleted via cascading, but the `SLItem`s should 
remain (with a null parent). 

Which means the `SLRecipe` -{ `SLItem` join must be set 
to `nullOnDelete`.

Therefore, when the user deletes a `SLRecipe` from a 
`ShoppingList` (and we can reasonably assume that they want 
the `SLItem`s to vanish too), we will need to 
explicitly delete the `SLItem`s before deleting the `SLRecipe`.