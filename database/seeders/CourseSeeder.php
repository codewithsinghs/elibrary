<?php

namespace Database\Seeders;


use App\Models\Course;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Course::factory()->count(10)->create();

        $courses = [
            [
                'name' => 'Google Ads and Analytics',
                'slug' => Str::slug('Google-Ads-and-Analytics'),
                'description' => 'A comprehensive course for beginners to learn Google-Ads-and-Analytics.',
                'duration' => 1,
                'category' => 'Digital Marketing',
                'level' => 'Beginner',
                'instructor' => 'Aisect Learn',
                'price' => 450,
                'image' => 'Google-Ads-and-Analytics.jpg',
            ],
            [
                'name' => 'Soil Testing',
                'slug' => Str::slug('soil-testing'),
                'description' => 'A comprehensive course for beginners to learn soil testing.',
                'duration' => 2,
                'category' => 'Agriculture',
                'level' => 'Intermediate',
                'instructor' => 'Aisect Learn',
                'price' => 900,
                'image' => 'soil-testing.jpg',
            ],
            [
                'name' => 'Embedded System Design',
                'slug' => Str::slug('Embedded-System-Design'),
                'description' => 'A comprehensive course for mid-level to learn Embedded System Design.',
                'duration' => 3,
                'category' => 'System Design',
                'level' => 'Proficient',
                'instructor' => 'Aisect Learn',
                'price' => 450,
                'image' => 'Google-Ads-and-Analytics.jpg',
            ],
            [
                'name' => 'Food Quality Assurance',
                'slug' => Str::slug('Food-Quality-Assurance'),
                'description' => 'A comprehensive course for Experienced to learn Food Quality Assurance.',
                'duration' => 2,
                'category' => 'Food Safety',
                'level' => 'Experienced',
                'instructor' => 'Aisect Learn',
                'price' => 1250,
                'image' => 'Food-Quality-Assurance.jpg',
            ],
            [
                'name' => 'Industrial Safety',
                'slug' => Str::slug('Industrial-Safety'),
                'description' => 'A comprehensive course for Advanced to learn Industrial Safety.',
                'duration' => 2,
                'category' => 'Industrial',
                'level' => 'Expert',
                'instructor' => 'Aisect Learn',
                'price' => 650,
                'image' => 'Industrial-Safety.jpg',
            ],
            [
                'name' => 'Web development',
                'slug' => Str::slug('Web-development'),
                'description' => 'A comprehensive course for Intermediate to learn Web development.',
                'duration' => 6,
                'category' => 'Tachnology',
                'level' => 'Advance',
                'instructor' => 'Aisect Learn',
                'price' => 2740,
                'image' => 'Web-development.jpg',
            ],
            [
                'name' => 'Content Writing',
                'slug' => Str::slug('Content-Writing'),
                'description' => 'A comprehensive course for beginners to learn Content Writing.',
                'duration' => 3,
                'category' => 'Digital Marketing',
                'level' => 'Beginner',
                'instructor' => 'Aisect Learn',
                'price' => 450,
                'image' => 'Content-Writing.jpg',
            ],
            [
                'name' => 'cryptography',
                'slug' => Str::slug('cryptography'),
                'description' => 'A comprehensive course for beginners to learn cryptography.',
                'duration' => 2,
                'category' => 'Digital Marketing',
                'level' => 'Beginner',
                'instructor' => 'Aisect Learn',
                'price' => 450,
                'image' => 'cryptography.jpg',
            ],
            [
                'name' => 'Python for Data Science',
                'slug' => Str::slug('Python-for-Data-Science'),
                'description' => 'A comprehensive course for Experienced to learn Python for Data Science.',
                'duration' => 1,
                'category' => 'Data Science',
                'level' => 'Exeprt',
                'instructor' => 'Aisect Learn',
                'price' => 1450,
                'image' => 'Python-for-Data-Science.jpg',
            ],
            [
                'name' => 'Digital Marketing',
                'slug' => Str::slug('Digital-Marketing'),
                'description' => 'A comprehensive course for beginners to learn Digital-Marketing.',
                'duration' => 3,
                'category' => 'Digital Marketing',
                'level' => 'Beginner',
                'instructor' => 'Aisect Learn',
                'price' => 450,
                'image' => 'Digital-Marketing.jpg',
            ],
            // Add 8 more courses here...
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
