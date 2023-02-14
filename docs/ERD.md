# ERD Diagram

````mermaid
erDiagram
          Family ||--o{ Shop : has
          Family ||--o{ User : has
          Shop   ||--o{ Product : has
          Family ||--o{ Recipe  : has
          Recipe ||--o{ Step    : has
          Recipe ||--o{ Ingredient : has
          Ingredient }o--|| Product : has
          Family ||--o{ ShoppingList : has
          SLItem }o--o| Ingredient : has
          Recipe ||--o{ SLRecipe : has
          ShoppingList ||--o{ SLRecipe : has
          SLRecipe |o--o{ SLItem : has
          ShoppingList ||--o{ SLItem : has
          SLItem }o--|| Product : has
````
