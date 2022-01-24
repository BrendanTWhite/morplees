# Restricting Models to Authorised Users

In this app we want users to only see their own family's recipes,
products, shops, etc.

There are several options for restricting access.

## Filters on Filament Table

Only works on the table. Doesn't eg filter for just that user's Shops 
when building a Shops filter on Products. Doesn't stop a user guessing 
a URL for some other user's record like [thing.com/products/42](https://google.com/)

````php
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('prep_time'),
                Tables\Columns\TextColumn::make('cook_time'),
            ])
            ->filters([
                SelectFilter::make('family')->relationship('family', 'name'),
            ]);
    }
````

## Laravel Policies

Works nicely with most of Filament but is not usable to restrict
access to records in a table.

This is because `viewAny()` must return either `true` or `false` 
for the user, regardless of which record they're looking at.
If it's `true` then the user can see all records including 
other users' records; if it's `false` then the user cannot see 
any records, not even their own.

````php
    public function viewAny(User $user) // no parameter for $record
    {
        return true;
    }
````

### Global Scope on the Booted Method on Laravel Model

Probably the best option so far. Seems to stop users from seeing other
users' records everywhere (including Filament tables and forms)
while still allowing them to see their own records everywhere.

````php
    protected static function booted()
    {
        static::addGlobalScope('ours', function (Builder $builder) {
            return $builder->where('family_id', '=', Auth::user()->family_id);
        });
    }
````

Can also be extended to allow admin users to see everyone's records.

````php
    protected static function booted()
    {
        static::addGlobalScope('ours', function (Builder $builder) {
            if (Auth::user()->is_admin) {
                return $builder;
            } else {
                return $builder->where('family_id', '=', Auth::user()->family_id);    
            }
            
        });
    }
````

### Laravel Global Scopes

Laravel's [Global Scopes](https://laravel.com/docs/8.x/eloquent#global-scopes) in a separate file are another option
and are probably cleaner. They can easily enough be overridden
where needed for eg admin access, but they will still take effect
without needing to remember to include them, once implemented.

We still need to include them in the model's `booted()` function,
but it's perhaps a little cleaner while still being overridable.
