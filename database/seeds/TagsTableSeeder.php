<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Laravel', 'Foundation', 'Slim', 'Bug', 'Rain']);
        $tags->each(function ($c) {
            Tag::create([
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
