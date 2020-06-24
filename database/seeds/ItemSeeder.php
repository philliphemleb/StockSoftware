<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => Str::random(10),
            'description' => Str::random(25),
            'amount' => random_int(1, 10),
        ]);
    }
}
