<?php

use App\product\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_type' => 'simple',
        'product_name' => $faker->name,
        'product_cost' => 1000,
        'product_price' => 1500,
        'product_alert_qty' => 5,
        'product_qty' => 10,
    ];
});