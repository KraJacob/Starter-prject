<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agence;

class AgenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agence::create([
            'nom' => 'Agence principale',
            'contact' => '00000000',
            'email' => 'admin@admin.com',
            'adresse' => 'Ypougon Maroc'
        ]);
    }
}
