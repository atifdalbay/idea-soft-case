<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                [
                    "name" => "Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti",
                    "category" => 1,
                    "price" => "120.75",
                    "stock" => 10
                ],
                [
                    "name" => "Reko Mini Tamir Hassas Tornavida Seti 32'li",
                    "category" => 1,
                    "price" => "49.50",
                    "stock" => 10
                ],
                [
                    "name" => "Viko Karre Anahtar - Beyaz",
                    "category" => 2,
                    "price" => "11.28",
                    "stock" => 10
                ],
                [
                    "name" => "Legrand Salbei Anahtar, Alüminyum",
                    "category" => 2,
                    "price" => "22.80",
                    "stock" => 10
                ],
                [
                    "description" => "Schneider Asfora Beyaz Komütatör",
                    "category" => 2,
                    "price" => "12.95",
                    "stock" => 10
                ],
            ],
        );
    }
}