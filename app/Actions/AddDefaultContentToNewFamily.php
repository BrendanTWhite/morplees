<?php

namespace App\Actions;

use App\Models\Family;
use App\Models\Shop;

class AddDefaultContentToNewFamily
{
    public function execute(Family $family)
    {
        // First, create new shops
        $family->shops()->createMany(self::$defaultShops);

        // Then, load the defualt products.
        // Note that we have shop names but not (yet) shop IDs.
        $products = self::$defaultProducts;

        // for each product, get (or create) a shop, and save the shop ID
        foreach ($products as $key => $product) {
            $shop = Shop::firstOrCreate([
                'name' => $product['shop_name'],
                'family_id' => $family->id,
            ]);
            $products[$key]['shop_id'] = $shop->id;
            unset($products[$key]['shop_name']);
        }

        // now add the new products
        $family->products()->createMany($products);
    }

    public static $defaultShops = [
        ['name' => 'Supermarket'],
        ['name' => 'Fruit & Veg'],
        ['name' => 'Butcher'],
        ['name' => 'Bakery'],
        ['name' => 'Health Food Shop'],
        ['name' => 'Chemist'],
        ['name' => 'Hardware'],
    ];

    public static $defaultProducts = [
        ['shop_name' => 'Bakery',      'name' => 'Bread'],
        ['shop_name' => 'Bottle Shop', 'name' => 'Red Wine'],
        ['shop_name' => 'Bottle Shop', 'name' => 'White Wine'],
        ['shop_name' => 'Butcher',     'name' => 'Bacon'],
        ['shop_name' => 'Butcher',     'name' => 'Beef Mince'],
        ['shop_name' => 'Butcher',     'name' => 'Casserole Beef'],
        ['shop_name' => 'Butcher',     'name' => 'Chicken'],
        ['shop_name' => 'Butcher',     'name' => 'Chicken Breast'],
        ['shop_name' => 'Butcher',     'name' => 'Chicken Thigh'],
        ['shop_name' => 'Butcher',     'name' => 'Chuck Steak '],
        ['shop_name' => 'Butcher',     'name' => 'Ham'],
        ['shop_name' => 'Butcher',     'name' => 'Pork'],
        ['shop_name' => 'Butcher',     'name' => 'Rump steak'],
        ['shop_name' => 'Butcher',     'name' => 'Sausages'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Bananas'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Almond meal'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Almonds'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Apples'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Apples, Green'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Apples, Red'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Apricots, dried'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Avocados'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Baby corn'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Baby Spinach'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Basil, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Bean shoots'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Beans, green'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Beetroot, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Broccoli'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Butternut pumpkin'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Cabbage'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Capers, baby'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Capsicum, green'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Capsicum, red'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Capsicum, yellow'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'cardamom pods'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'cardamom seeds'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Cardamom, ground'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Carrots'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Cashews, raw'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Cauliflower'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Celery'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Chili'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Chilli, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Chilli, green'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Chilli, red'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Chives, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Coconut, shredded'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Coriander, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Corn Kernels, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Couscous'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Cucumber'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Dates, medjool'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Dates, pitted'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Dill, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Garlic cloves'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Ginger, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Green Beans'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Green split peas'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'iceberg lettuce'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Leek'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Lemon Wedges'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Lemon zest'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Lemongrass'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'lettuce'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Lime juice'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Limes'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'mango'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Medjool dates, pitted'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Mint, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Mushrooms'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Onion, brown'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Onion, red'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Onions'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Oregano, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Parlsey'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Parsley, flat-leaf'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Parsley, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Parsnip'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Peanuts'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Peas'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Pepitas / Pumpkin seeds'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Peppercorns'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Pineapple'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Potato'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Potatoes'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Prunes'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Pumpkin'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Radish'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Raisins'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Rocket leaves'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Rosemary leaves'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Sage leaves'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Shallots'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Shallots, green'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'shitake mushrooms, dried'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Snow Peas'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Spinach'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Spinach leaves'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Spring Onion'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Sweet Potato'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Thyme'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'tomato, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Tomatoes, cherry'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Tomatoes, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Tomatoes, roma'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Tumeric, fresh'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Yellow split peas'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Zucchini'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Zucchini, large'],
        ['shop_name' => 'Fruit & Veg', 'name' => 'Zucchini, small'],
        ['shop_name' => 'Supermarket', 'name' => 'Air Freshener'],
        ['shop_name' => 'Supermarket', 'name' => 'Baby Wipes'],
        ['shop_name' => 'Supermarket', 'name' => 'Bandaids'],
        ['shop_name' => 'Supermarket', 'name' => 'Batteries'],
        ['shop_name' => 'Supermarket', 'name' => 'Bicarbonate'],
        ['shop_name' => 'Supermarket', 'name' => 'Body Wash'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese Slices'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese, Pecorino'],
        ['shop_name' => 'Supermarket', 'name' => 'Corn Flakes'],
        ['shop_name' => 'Supermarket', 'name' => 'Deodorant'],
        ['shop_name' => 'Supermarket', 'name' => 'Dishwasher Powder Tablets'],
        ['shop_name' => 'Supermarket', 'name' => 'Dutch Cocoa'],
        ['shop_name' => 'Supermarket', 'name' => 'Freezer bags'],
        ['shop_name' => 'Supermarket', 'name' => 'Hand soap'],
        ['shop_name' => 'Supermarket', 'name' => 'Laundry Powder'],
        ['shop_name' => 'Supermarket', 'name' => 'Peanut Butter (smooth)'],
        ['shop_name' => 'Supermarket', 'name' => 'Rice Bubbles'],
        ['shop_name' => 'Supermarket', 'name' => 'Rubbish Bags'],
        ['shop_name' => 'Supermarket', 'name' => 'Soy Milk'],
        ['shop_name' => 'Supermarket', 'name' => 'Tissues'],
        ['shop_name' => 'Supermarket', 'name' => 'Toothbrush'],
        ['shop_name' => 'Supermarket', 'name' => 'Toothpaste'],
        ['shop_name' => 'Supermarket', 'name' => 'Vegemite'],
        ['shop_name' => 'Supermarket', 'name' => 'Wraps'],
        ['shop_name' => 'Supermarket', 'name' => 'Allspice'],
        ['shop_name' => 'Supermarket', 'name' => 'Basil, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Bay leaves'],
        ['shop_name' => 'Supermarket', 'name' => 'Black pepper'],
        ['shop_name' => 'Supermarket', 'name' => 'Cacao powder'],
        ['shop_name' => 'Supermarket', 'name' => 'Cayenne Pepper'],
        ['shop_name' => 'Supermarket', 'name' => 'Chia seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Chili powder'],
        ['shop_name' => 'Supermarket', 'name' => 'Chilli flakes'],
        ['shop_name' => 'Supermarket', 'name' => 'Cinnamon'],
        ['shop_name' => 'Supermarket', 'name' => 'cinnamon stick'],
        ['shop_name' => 'Supermarket', 'name' => 'Cloves'],
        ['shop_name' => 'Supermarket', 'name' => 'Coconut oil'],
        ['shop_name' => 'Supermarket', 'name' => 'Coriander Seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Coriander, ground'],
        ['shop_name' => 'Supermarket', 'name' => 'Cranberries, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'cream cheese'],
        ['shop_name' => 'Supermarket', 'name' => 'Cumin seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Cumin, ground'],
        ['shop_name' => 'Supermarket', 'name' => 'Currants, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Dessicated coconut'],
        ['shop_name' => 'Supermarket', 'name' => 'Egg'],
        ['shop_name' => 'Supermarket', 'name' => 'Egg white'],
        ['shop_name' => 'Supermarket', 'name' => 'Egg Yolk'],
        ['shop_name' => 'Supermarket', 'name' => 'Fenugreek seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Feta'],
        ['shop_name' => 'Supermarket', 'name' => 'Garam Masala'],
        ['shop_name' => 'Supermarket', 'name' => 'Garlic powder'],
        ['shop_name' => 'Supermarket', 'name' => 'Ginger, ground'],
        ['shop_name' => 'Supermarket', 'name' => 'Haloumi'],
        ['shop_name' => 'Supermarket', 'name' => 'Honey'],
        ['shop_name' => 'Supermarket', 'name' => 'jalapenos, pickled'],
        ['shop_name' => 'Supermarket', 'name' => 'Lentils, split red'],
        ['shop_name' => 'Supermarket', 'name' => 'Linseeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Macadamia nuts'],
        ['shop_name' => 'Supermarket', 'name' => 'Milk'],
        ['shop_name' => 'Supermarket', 'name' => 'Mixed Herbs'],
        ['shop_name' => 'Supermarket', 'name' => 'Mustard seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Nutmeg, ground'],
        ['shop_name' => 'Supermarket', 'name' => 'Oil, coconut'],
        ['shop_name' => 'Supermarket', 'name' => 'Onion flakes, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Onion Seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Oregano, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Paprika, ground'],
        ['shop_name' => 'Supermarket', 'name' => 'Paprika, smoked'],
        ['shop_name' => 'Supermarket', 'name' => 'Paprika, sweet'],
        ['shop_name' => 'Supermarket', 'name' => 'Parmesan'],
        ['shop_name' => 'Supermarket', 'name' => 'Parsley, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Pepper'],
        ['shop_name' => 'Supermarket', 'name' => 'Pepper, black'],
        ['shop_name' => 'Supermarket', 'name' => 'Pine nuts'],
        ['shop_name' => 'Supermarket', 'name' => 'Prosciutto'],
        ['shop_name' => 'Supermarket', 'name' => 'Quinoa'],
        ['shop_name' => 'Supermarket', 'name' => 'Rice'],
        ['shop_name' => 'Supermarket', 'name' => 'Rice, Brown'],
        ['shop_name' => 'Supermarket', 'name' => 'Ricotta'],
        ['shop_name' => 'Supermarket', 'name' => 'Rolled Oats'],
        ['shop_name' => 'Supermarket', 'name' => 'Sesame Seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Sultanas'],
        ['shop_name' => 'Supermarket', 'name' => 'sun-dried tomatoes'],
        ['shop_name' => 'Supermarket', 'name' => 'Sunflower seeds'],
        ['shop_name' => 'Supermarket', 'name' => 'Tahini'],
        ['shop_name' => 'Supermarket', 'name' => 'Thyme, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomatoes, semi-dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomatoes, sundried'],
        ['shop_name' => 'Supermarket', 'name' => 'Tumeric, ground'],
        ['shop_name' => 'Supermarket', 'name' => 'Vinegar, red wine'],
        ['shop_name' => 'Supermarket', 'name' => 'Walnuts'],
        ['shop_name' => 'Supermarket', 'name' => 'White Wine Vinegar'],
        ['shop_name' => 'Supermarket', 'name' => 'Yoghurt, Greek'],
        ['shop_name' => 'Supermarket', 'name' => 'Yoghurt, natural'],
        ['shop_name' => 'Supermarket', 'name' => '9V Battery'],
        ['shop_name' => 'Supermarket', 'name' => 'Apple Cider Vinegar'],
        ['shop_name' => 'Supermarket', 'name' => 'apricot nectar'],
        ['shop_name' => 'Supermarket', 'name' => 'arborio rice'],
        ['shop_name' => 'Supermarket', 'name' => 'Bacon'],
        ['shop_name' => 'Supermarket', 'name' => 'Baked Beans'],
        ['shop_name' => 'Supermarket', 'name' => 'Balsamic Vinegar'],
        ['shop_name' => 'Supermarket', 'name' => 'Basalmic Vinegar'],
        ['shop_name' => 'Supermarket', 'name' => 'Basmati rice'],
        ['shop_name' => 'Supermarket', 'name' => 'Beetroot, tinned'],
        ['shop_name' => 'Supermarket', 'name' => 'Black Beans'],
        ['shop_name' => 'Supermarket', 'name' => 'Bread Improver'],
        ['shop_name' => 'Supermarket', 'name' => 'Butter'],
        ['shop_name' => 'Supermarket', 'name' => 'Butter, Salted'],
        ['shop_name' => 'Supermarket', 'name' => 'Cannellini beans'],
        ['shop_name' => 'Supermarket', 'name' => 'Cat Food'],
        ['shop_name' => 'Supermarket', 'name' => 'Cat Litter'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese, Cheddar'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese, grated'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese, Mozzarella'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese, Parmesan'],
        ['shop_name' => 'Supermarket', 'name' => 'Cheese, vintage cheddar'],
        ['shop_name' => 'Supermarket', 'name' => 'Cherries, pitted'],
        ['shop_name' => 'Supermarket', 'name' => 'Chickpeas'],
        ['shop_name' => 'Supermarket', 'name' => 'Chocolate, Dark'],
        ['shop_name' => 'Supermarket', 'name' => 'Chocolate, Milk'],
        ['shop_name' => 'Supermarket', 'name' => 'Coconut Cream'],
        ['shop_name' => 'Supermarket', 'name' => 'coconut milk'],
        ['shop_name' => 'Supermarket', 'name' => 'Corn chips'],
        ['shop_name' => 'Supermarket', 'name' => 'corn kernels, frozen'],
        ['shop_name' => 'Supermarket', 'name' => 'Cornflour'],
        ['shop_name' => 'Supermarket', 'name' => 'Cream'],
        ['shop_name' => 'Supermarket', 'name' => 'Cream of Tartar'],
        ['shop_name' => 'Supermarket', 'name' => 'Cream, lactose free'],
        ['shop_name' => 'Supermarket', 'name' => 'Crumpets'],
        ['shop_name' => 'Supermarket', 'name' => 'Curry Powder'],
        ['shop_name' => 'Supermarket', 'name' => 'Dijon Mustard'],
        ['shop_name' => 'Supermarket', 'name' => 'Dog Food'],
        ['shop_name' => 'Supermarket', 'name' => 'egg noodles'],
        ['shop_name' => 'Supermarket', 'name' => 'Epsom Salts'],
        ['shop_name' => 'Supermarket', 'name' => 'Feta, crumbly'],
        ['shop_name' => 'Supermarket', 'name' => 'Flour, Gluten Free'],
        ['shop_name' => 'Supermarket', 'name' => 'Flour, plain'],
        ['shop_name' => 'Supermarket', 'name' => 'Flour, Self Raising'],
        ['shop_name' => 'Supermarket', 'name' => 'gherkin slices'],
        ['shop_name' => 'Supermarket', 'name' => 'Gnocchi'],
        ['shop_name' => 'Supermarket', 'name' => 'grapeseed oil'],
        ['shop_name' => 'Supermarket', 'name' => 'Greek Yoghurt'],
        ['shop_name' => 'Supermarket', 'name' => 'Green peas, frozen'],
        ['shop_name' => 'Supermarket', 'name' => 'Ham'],
        ['shop_name' => 'Supermarket', 'name' => 'Hamburger buns'],
        ['shop_name' => 'Supermarket', 'name' => 'Icecream, vanilla'],
        ['shop_name' => 'Supermarket', 'name' => 'Lactose Free Milk'],
        ['shop_name' => 'Supermarket', 'name' => 'Lasagne sheets'],
        ['shop_name' => 'Supermarket', 'name' => 'Lemon Juice'],
        ['shop_name' => 'Supermarket', 'name' => 'Lentils, red'],
        ['shop_name' => 'Supermarket', 'name' => 'Lentils, yellow'],
        ['shop_name' => 'Supermarket', 'name' => 'Macaroni pasta'],
        ['shop_name' => 'Supermarket', 'name' => 'Maple Syrup'],
        ['shop_name' => 'Supermarket', 'name' => 'Margarine'],
        ['shop_name' => 'Supermarket', 'name' => 'Mayonaise'],
        ['shop_name' => 'Supermarket', 'name' => 'Mozzarella'],
        ['shop_name' => 'Supermarket', 'name' => 'Mustard Powder'],
        ['shop_name' => 'Supermarket', 'name' => 'mustard, dijon'],
        ['shop_name' => 'Supermarket', 'name' => 'Mustard, Wholegrain'],
        ['shop_name' => 'Supermarket', 'name' => 'Nappies'],
        ['shop_name' => 'Supermarket', 'name' => 'Oil'],
        ['shop_name' => 'Supermarket', 'name' => 'Olive Oil'],
        ['shop_name' => 'Supermarket', 'name' => 'Olives, green'],
        ['shop_name' => 'Supermarket', 'name' => 'Olives, pitted green Sicilian'],
        ['shop_name' => 'Supermarket', 'name' => 'Palm sugar'],
        ['shop_name' => 'Supermarket', 'name' => 'Passata'],
        ['shop_name' => 'Supermarket', 'name' => 'Pasta'],
        ['shop_name' => 'Supermarket', 'name' => 'Pasta Sauce'],
        ['shop_name' => 'Supermarket', 'name' => 'Peanut Butter (crunchy)'],
        ['shop_name' => 'Supermarket', 'name' => 'Peas, frozen'],
        ['shop_name' => 'Supermarket', 'name' => 'Polenta'],
        ['shop_name' => 'Supermarket', 'name' => 'Pork Steaks'],
        ['shop_name' => 'Supermarket', 'name' => 'Puff Pastry'],
        ['shop_name' => 'Supermarket', 'name' => 'Rapadura'],
        ['shop_name' => 'Supermarket', 'name' => 'Red Kidney Beans'],
        ['shop_name' => 'Supermarket', 'name' => 'Rice, Basmati'],
        ['shop_name' => 'Supermarket', 'name' => 'Rice, long grain'],
        ['shop_name' => 'Supermarket', 'name' => 'Salami'],
        ['shop_name' => 'Supermarket', 'name' => 'Salt'],
        ['shop_name' => 'Supermarket', 'name' => 'Sanitary Pads'],
        ['shop_name' => 'Supermarket', 'name' => 'Sea Salt'],
        ['shop_name' => 'Supermarket', 'name' => 'Sesame Oil'],
        ['shop_name' => 'Supermarket', 'name' => 'Shampoo'],
        ['shop_name' => 'Supermarket', 'name' => 'Shaver cartridges'],
        ['shop_name' => 'Supermarket', 'name' => 'Soap'],
        ['shop_name' => 'Supermarket', 'name' => 'Sour Cream'],
        ['shop_name' => 'Supermarket', 'name' => 'Soy Sauce'],
        ['shop_name' => 'Supermarket', 'name' => 'spinach, frozen'],
        ['shop_name' => 'Supermarket', 'name' => 'Sugar'],
        ['shop_name' => 'Supermarket', 'name' => 'Sugar, brown'],
        ['shop_name' => 'Supermarket', 'name' => 'Sugar, raw'],
        ['shop_name' => 'Supermarket', 'name' => 'Sunscreen'],
        ['shop_name' => 'Supermarket', 'name' => 'Tahini, hulled'],
        ['shop_name' => 'Supermarket', 'name' => 'Tampons'],
        ['shop_name' => 'Supermarket', 'name' => 'Thick RiceStick Noodles'],
        ['shop_name' => 'Supermarket', 'name' => 'Toilet cleaner'],
        ['shop_name' => 'Supermarket', 'name' => 'Toilet paper'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomato'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomato paste'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomato Puree'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomato Sauce'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomato tins'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomatoes'],
        ['shop_name' => 'Supermarket', 'name' => 'Tomatoes, fire roasted'],
        ['shop_name' => 'Supermarket', 'name' => 'Tortillas'],
        ['shop_name' => 'Supermarket', 'name' => 'Tortillas'],
        ['shop_name' => 'Supermarket', 'name' => 'Vanilla'],
        ['shop_name' => 'Supermarket', 'name' => 'Vermicelli Noodles'],
        ['shop_name' => 'Supermarket', 'name' => 'Vinegar, white'],
        ['shop_name' => 'Supermarket', 'name' => 'water chestnuts'],
        ['shop_name' => 'Supermarket', 'name' => 'Weetbix'],
        ['shop_name' => 'Supermarket', 'name' => 'White Wine'],
        ['shop_name' => 'Supermarket', 'name' => 'Worcestershire sauce'],
        ['shop_name' => 'Supermarket', 'name' => 'Yeast, dried'],
        ['shop_name' => 'Supermarket', 'name' => 'Yoghurt'],
    ];
}
