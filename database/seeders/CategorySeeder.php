<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            [
                'id'    => 1,
                'name'  => 'Buah-buahan',
                'slug'  => 'buah-buahan',
                'created_at' => now()
            ],
            [
                'id'    => 2,
                'name'  => 'Makanan Ringan',
                'slug'  => 'makanan-ringan',
                'created_at' => now()
            ],
            [
                'id'    => 3,
                'name'  => 'Minuman',
                'slug'  => 'minuman',
                'created_at' => now()
            ],
        ]);

        $categories->each(function ($category){
            Category::insert($category);
        });
    }
}
