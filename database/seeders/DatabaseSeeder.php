<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Food;
use App\Models\Igredients;
use App\Models\Menu;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $foodNames = [
            'Osh',
            'Lagman',
            'Manti',
            'Shashlik',
            'Plov',
            'Somsa',
            'Dolma',
            'Norin',
            'Shurpa',
            'Kebab'
        ];
        
        foreach ($foodNames as $name) {
            Food::factory()->create([
                'name' => $name,
            ]);
        }
        
        $igredientsNames = [
            'Лук',
            'Морковь',
            'Картофель',
            'Чеснок',
            'Помидор',
            'Перец',
            'Кабачок',
            'Баклажан',
            'Говядина',
            'Курица'
        ];        

        foreach ($igredientsNames as $name) {
            Igredients::factory()->create([
                'name' => $name,
            ]);
        }

        $foods = Food::all();
        $igredients = Igredients::all();

        foreach ($foods as $food) {

            $randomIngredients = $igredients->random(rand(2, 3));

            foreach ($randomIngredients as $ingredient) {
                Menu::factory()->create([
                    'food_id' => $food->id,
                    'igredient_id' => $ingredient->id,
                ]);
            }
        }
    }
}
