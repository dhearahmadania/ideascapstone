<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = collect([
            [
                'name' => 'Buah',
                'short_code' => 'B'
            ],
            [
                'name' => 'Kemasan',
                'short_code' => 'pak'
            ],
            [
                'name' => 'Kilogram',
                'short_code' => 'kg'
            ]
        ]);

        $units->each(function ($unit){
            Unit::insert($unit);
        });
    }
}
