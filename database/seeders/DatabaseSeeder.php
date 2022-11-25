<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\OptionFactory;
use Database\Factories\OptionValueFactory;
use Database\Factories\ProductFactory;
use Database\Factories\PropertyFactory;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        BrandFactory::new()->count(20)->create();

        $properties = PropertyFactory::new()
            ->count(10)
            ->create();

        OptionFactory::new()->count(2)->create();

        $optionValues = OptionValueFactory::new()->count(10)->create();


        CategoryFactory::new()->count(10)
            ->has(
                ProductFactory::new()->count(10)
                    ->hasAttached($optionValues)
                    ->hasAttached($properties, function () {
                        return [
                            'value' => ucfirst(fake()->word())
                        ];
                    })
            )
        ->create();

//        ProductFactory::new()->count(20)
//            ->has(CategoryFactory::new()->count(rand(1,3)))
//            ->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
