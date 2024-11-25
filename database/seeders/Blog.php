<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Blog extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            [
                'user_id' => 2,
                'category_id' => 2,
                'image' => 'https://example.com/images/fashion1.jpg',
                'title' => 'Top Fashion Trends for 2024',
                'slug' => 'top-fashion-trends-2024',
                'description' => 'Discover the latest trends that are taking the fashion world by storm this year, including vibrant colors, oversized silhouettes, and sustainable materials.',
                'seo_title' => 'Fashion Trends 2024 - Stay Ahead of the Curve',
                'seo_description' => 'Explore the hottest fashion trends for 2024. From styles to fabrics, learn what to wear this year!',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'image' => 'https://example.com/images/fashion2.jpg',
                'title' => 'How to Style Your Wardrobe for Any Occasion',
                'slug' => 'style-your-wardrobe',
                'description' => 'Learn how to mix and match pieces in your wardrobe to create stylish outfits for any occasion, from casual outings to formal events.',
                'seo_title' => 'Wardrobe Styling Tips - Fashion for Every Occasion',
                'seo_description' => 'Master the art of wardrobe styling with our expert tips for creating looks suitable for any occasion.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 2,
                'image' => 'https://example.com/images/fashion3.jpg',
                'title' => 'Sustainable Fashion: Making Eco-Friendly Choices',
                'slug' => 'sustainable-fashion',
                'description' => 'Discover how to make eco-conscious choices in your fashion purchases, including tips on choosing sustainable brands and materials.',
                'seo_title' => 'Sustainable Fashion Guide - Eco-Friendly Choices',
                'seo_description' => 'Embrace sustainable fashion with our comprehensive guide on eco-friendly choices for your wardrobe.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'category_id' => 1,
                'image' => 'https://example.com/images/fashion4.jpg',
                'title' => 'Accessorizing: The Key to Elevating Your Outfits',
                'slug' => 'accessorizing-outfits',
                'description' => 'Learn how to accessorize your outfits effectively to enhance your personal style and make a statement.',
                'seo_title' => 'Accessorizing Tips - Elevate Your Style',
                'seo_description' => 'Unlock the secrets of accessorizing with our tips to elevate your fashion game.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
