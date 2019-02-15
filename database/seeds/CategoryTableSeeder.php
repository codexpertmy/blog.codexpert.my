<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $categories = [
            'Web development',
            'Servers',
            'Dev tools',
            'Optimizations',
            'Debugging',
            'Data Structures',
            'Unit Testing',
            'REST Api',
        ];

        return collect($categories)
            ->each(function ($category) {

                Category::create([
                    'code' => strtolower(str_replace([' '], '_', $category)),
                    'name' => $category,
                ]);
            });
    }
}
