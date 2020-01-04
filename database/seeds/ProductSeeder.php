<?php

use App\Model\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker\factory::create();
        for ($i=0;$i<=50;$i++){
            Product::create([
                'name'=>$faker->name,
                'detail'=>$faker->paragraph,
                'price'=>$faker->numberBetween(100,1000),
                'stock'=>$faker->randomDigit(),
                'discount'=>$faker->numberBetween(2,30),
            ]);
        }
    }
}
