<?php

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
        factory(App\Item::class, 500)->create()->each(function ($item) {
           $item->tags()->save(factory(App\Tag::class)->make());
           $item->categories()->save(factory(App\Category::class)->make());
        });
    }
}
