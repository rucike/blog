<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Types;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
        Types::create([
            'type' => 'Verslo / įmonių tinklaraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai prekės ženklų / profesionalūs tinklaraščiai'
        ]);
        Types::create([
            'type' => 'Mados dienoraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
        Types::create([
            'type' => 'Asmeniniai dienoraščiai'
        ]);
    }
}
