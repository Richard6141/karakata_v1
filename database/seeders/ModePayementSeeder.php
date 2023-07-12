<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModePayementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mode = [
            'ESPECE',
            'MTN Mobile Money',
            'Tiket ORA BANK',
            'TIKET MTN SHINE 2500',
            'TIKET MTN SHINE 3500',
            'TIKET SGB',
            'PP-SP',
            'TL10',
            'TL5',
            'ABONNEE SMP',
            'OFFERT',
            'Ticket'
        ];

        foreach ($mode as $mode) {

            DB::table('mode_paiements')->insert([
                'id' => Str::uuid(),
                'label' => $mode,
            ]);
        }
    }
}
