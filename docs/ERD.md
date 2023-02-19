# ERD Diagram

## Delete Options
Options for Delete (from [the doco](https://laravel.com/docs/9.x/migrations#foreign-key-constraints))
- cascadeOnDelete
- restrictOnDelete
- nullOnDelete

## cascadeOnDelete
Child records get deleted. For example if the user
deletes a `Recipe`, the `Steps` and `Ingredients` 
should also vanish.

## restrictOnDelete
Can't delete parent.
- But explain why the delete failed
- Also - for `Family` to Anything - make it restrictOnDelete, but we (eventually) want to offer Redact instead of Delete.

## nullOnDelete
Child remains, gets `null` as their parent.
*Note* - parent_id field on child must be `->nullable()`

## ERD Diagram
... with delete options

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

*Note* - when a `Recipe` is deleted, any related `SLRecipes`
should be deleted via cascading, but the `SLItems` should 
remain (with a null parent). 

Which means the `SLRecipe` -{ `SLItem` join must be set 
to `nullOnDelete`.

However, when the user deletes a `SLRecipe` from a 
`ShoppingList`, we can reasonably assume that they want 
the `SLItem`s to vanish too. Therefore we will need to 
explicitly delete the `SLItem`s before deleting the `SLRecipe`.
