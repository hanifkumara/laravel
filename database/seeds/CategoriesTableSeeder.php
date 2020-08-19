<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['Framework', 'Code']);
        $categories->each(function ($c) {
            Category::create([
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
