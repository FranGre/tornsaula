<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Module::factory(5)->create();
        Module::create(['name' => 'PWES', 'description' => 'PHP y Laravel']);
        Module::create(['name' => 'PWEC', 'description' => 'JS y Vue']);
        Module::create(['name' => 'DIW', 'description' => 'CSS, SASS, Tailwind...']);
        Module::create(['name' => 'DDAW', 'description' => 'Desplegar webs']);
    }
}
