<?php

namespace App\Traits;

use App\Scopes\JustMyFamilyScope;

trait BelongsToFamily 
{

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function bootBelongsToFamily()
    {
        static::addGlobalScope(new JustMyFamilyScope);

        static::creating(function($model) {
            $model->family_id = session(key:'family_id');
        });
    }

}