<?php

namespace Database\Seeders;

use App\Models\Igredients;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IgredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Igredients::factory()->count(15)->create();
    }
}
