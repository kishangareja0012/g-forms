<?php

namespace Database\Seeders;

use App\Models\Input;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Input::insert([
            ['name' => 'Text', 'type' => 'text'],
            ['name' => 'Text Box', 'type' => 'textarea'],
            ['name' => 'Radio', 'type' => 'radio'],
            ['name' => 'Check Box', 'type' => 'checkbox'],
            ['name' => 'Drop-down', 'type' => 'select'],
        ]);
    }
}
