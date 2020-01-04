<?php

use App\Model\Product;
use App\Model\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\factory::create();
        $product=Product::all()->pluck('id');
        for ($i=1;$i<=300;$i++){
            Review::create([
                'product_id'=>$faker->randomElement($product),
                'customer'=>$faker->name,
                'review'=>$faker->paragraph,
                'star'=>$faker->numberBetween(0,5)
            ]);
        }
    }
}
