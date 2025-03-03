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
        $categories = [
            'Plantas',
            'Artesanatos',
            'Bijuterias',
            'Vestuários',
            'Eletrônicos / Informática',
            'Eletrodomésticos',
            'Papelaria',
            'Livraria',
            'Raridades'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['category_name' => $category]);
        }
    }
}
