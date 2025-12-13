<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();

        // $categories = [
        //     'Access Control' => ['Biometric', 'Standalone', 'Accessories', 'Software'],
        //     'Time Attendance' => ['Biometric', 'Standalone', 'Accessories', 'Software'],
        //     'Alarm' => [
        //         'Intrude Alarm' => ['Wired', 'Wireless'],
        //         'Fire Alarm' => ['Conventional Alarm', 'Addressable Alarm', 'Fireman Flame Alarm'],
        //         'Water Leakage Alarm',
        //         'Temperature Alarm'
        //     ],
        //     'Video Door Phone' => ['IP Video', 'Two Wired Phone', 'Four Wired Phone'],
        //     'Entrance Control' => ['Smart Door Lock', 'Tripod', 'Gate Barrier', 'Flap Barrier'],
        //     'Anti-Theft System' => ['AM System', 'RF System'],
        // ];

        // foreach ($categories as $category => $subcategories) {
        //     $categoryId = DB::table('categories')->insertGetId([
        //         'name' => $category,
        //         'slug' => Str::slug($category),
        //         'img' => null,
        //         'is_active' => true,
        //         'description' => null,
        //         'parent_id' => null
        //     ]);

        //     foreach ($subcategories as $key => $subcategory) {
        //         if (is_array($subcategory)) {
        //             // For subcategories with nested subcategories
        //             $parentId = DB::table('categories')->insertGetId([
        //                 'name' => $key,
        //                 'slug' => Str::slug($key),
        //                 'img' => null,
        //                 'is_active' => true,
        //                 'description' => null,
        //                 'parent_id' => $categoryId
        //             ]);
        //             foreach ($subcategory as $nestedSub) {
        //                 DB::table('categories')->insert([
        //                     'name' => $nestedSub,
        //                     'slug' => Str::slug($nestedSub),
        //                     'img' => null,
        //                     'is_active' => true,
        //                     'description' => null,
        //                     'parent_id' => $parentId
        //                 ]);
        //             }
        //         } else {
        //             DB::table('categories')->insert([
        //                 'name' => $subcategory,
        //                 'slug' => Str::slug($subcategory),
        //                 'img' => null,
        //                 'is_active' => true,
        //                 'description' => null,
        //                 'parent_id' => $categoryId
        //             ]);
        //         }
        //     }
        // }

        $categories = [
            'Access Control' => ['Biometric', 'Standalone', 'Accessories', 'Software'],
            'Time Attendance' => ['Biometric', 'Standalone', 'Accessories', 'Software'],
            'Alarm' => [
                'Intrude Alarm' => ['Wired', 'Wireless'],
                'Fire Alarm' => ['Conventional Alarm', 'Addressable Alarm', 'Fireman Flame Alarm'],
                'Water Leakage Alarm',
                'Temperature Alarm'
            ],
            'Video Door Phone' => ['IP Video', 'Two Wired Phone', 'Four Wired Phone'],
            'Entrance Control' => ['Smart Door Lock', 'Tripod', 'Gate Barrier', 'Flap Barrier'],
            'Anti-Theft System' => ['AM System', 'RF System'],
        ];

        foreach ($categories as $category => $subcategories) {
            $categorySlug = Str::slug($category);
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $category,
                'slug' => $categorySlug,
                'img' => null,
                'is_active' => true,
                'description' => null,
                'parent_id' => null
            ]);

            foreach ($subcategories as $key => $subcategory) {
                if (is_array($subcategory)) {
                    // For subcategories with nested subcategories
                    $parentSlug = $categorySlug . '-' . Str::slug($key);
                    $parentId = DB::table('categories')->insertGetId([
                        'name' => $key,
                        'slug' => $parentSlug,
                        'img' => null,
                        'is_active' => true,
                        'description' => null,
                        'parent_id' => $categoryId
                    ]);
                    foreach ($subcategory as $nestedSub) {
                        DB::table('categories')->insert([
                            'name' => $nestedSub,
                            'slug' => $parentSlug . '-' . Str::slug($nestedSub),
                            'img' => null,
                            'is_active' => true,
                            'description' => null,
                            'parent_id' => $parentId
                        ]);
                    }
                } else {
                    DB::table('categories')->insert([
                        'name' => $subcategory,
                        'slug' => $categorySlug . '-' . Str::slug($subcategory),
                        'img' => null,
                        'is_active' => true,
                        'description' => null,
                        'parent_id' => $categoryId
                    ]);
                }
            }
        }
    }
}
