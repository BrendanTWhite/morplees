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
Child remains, gets ~null~ as their parent
Note - parent_id field on child must be ~->nullable()~

````mermaid

    erDiagram

        Family   ||--o{ ShoppingList : restrictOnDelete
        ShoppingList ||--o{ SLItem : cascadeOnDelete

        ShoppingList ||--o{ SLRecipe : cascadeOnDelete

        Family   ||--o{ Recipe     : restrictOnDelete

        Recipe   ||--o{ SLRecipe   : cascadeOnDelete
        SLRecipe |o--o{ SLItem     : nullOnDelete

        Recipe   ||--o{ Ingredient : cascadeOnDelete
        Recipe   ||--o{ Step       : cascadeOnDelete
        Ingredient |o--o{ SLItem   : nullOnDelete 

        Family   ||--o{ Shop       : restrictOnDelete
        Shop     ||--o{ Product    : restrictOnDelete

        Product    ||--o{ Ingredient : restrictOnDelete
        Product    ||--o{ SLItem   : restrictOnDelete

        Family   ||--|{ User       : restrictOnDelete

````

*Note* - when a `SLRecipe` is deleted from a `ShoppingList`, 
then the `SLItem`s will need to be explicitly deleted first.

Because when a `Recipe` is deleted, any related `SLRecipe`
will be deleted via cascading, but the `SLItem` will remain
with a null parent. Which means we have `SLRecipe` to 
`SLItem` set to  `nullOnDelete` not `cascadeOnDelete`.
