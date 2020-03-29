<?php

use Illuminate\Database\Seeder;
use App\Product as ProductEloquent;
use App\Picture as PictureEloquent;
use App\Material as MaterialEloquent;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = factory(ProductEloquent::class, 10)->create()->each(function($product){
            $picture_count = rand(0, 5);
            $recipe_count = rand(1, 5);
            
            for($i = 0; $i < $picture_count; $i++){
                $product->pictures()->save(
                    factory(PictureEloquent::class)->make([
                        'index' => $product->pictures()->count() + 1
                    ])
                );
            }

            $costprice = 0;
            $profit = rand(10, 100);
            for($i = 0; $i < $recipe_count; $i++){
                $material = MaterialEloquent::inRandomOrder()->first();
                $ratio = rand(1, 100) / 100;
                $subcost = round($material->unitPrice * $ratio, 4);
                $costprice += $subcost;

                $product->materials()->attach($material->id, [
                    'ratio' => $ratio,
                    'subcost' => $subcost
                ]);
            }
            
            $product->costprice = round($costprice, 4);
            $product->profit = $profit;
            $product->retailPrice = round($costprice + $profit, 4);
            $product->save();
        });
    }
}
