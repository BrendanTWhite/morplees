<?php

namespace App\Actions;

use App\Models\Family;
use App\Models\Shop;

class AddDefaultContentToNewFamily
{

    public function execute(Family $family)
    {
        $family->shops()->createMany(self::$defaultShops);
        $family->shops()->createMany(self::$defaultProducts);
        
    }

    static $defaultShops = [
        [ 'name' => 'Supermarket'      ],
        [ 'name' => 'Fruit & Veg'      ],
        [ 'name' => 'Butcher'          ],
        [ 'name' => 'Bakery'           ],
        [ 'name' => 'Health Food Shop' ],
        [ 'name' => 'Chemist'          ],
        [ 'name' => 'Hardware'         ],
    ];

    static $defaultProducts = [

    ];
}
