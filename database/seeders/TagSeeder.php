<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //創建分類
        $names = [
            '未分類'
        ];

        foreach ($names as $name) {
            Tag::findOrCreate($name, 'post_category');
        }
    }
}
