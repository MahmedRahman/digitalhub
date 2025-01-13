<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $instructors = Instructor::all();
        $categories = Category::all();

        $courses = [
            [
                'title' => 'أساسيات التسويق الرقمي',
                'description' => 'تعلم أساسيات التسويق الرقمي من الصفر وحتى الاحتراف.',
                'level' => 'مبتدئ',
                'image' => 'https://placehold.co/800x600/e9ecef/495057?text=Digital+Marketing'
            ],
            [
                'title' => 'احتراف إعلانات فيسبوك وانستجرام',
                'description' => 'دورة شاملة في إدارة الحملات الإعلانية على فيسبوك وانستجرام.',
                'level' => 'متوسط',
                'image' => 'https://placehold.co/800x600/e9ecef/495057?text=Facebook+Ads'
            ],
            [
                'title' => 'تسويق المحتوى الرقمي',
                'description' => 'تعلم كيفية إنشاء وتسويق المحتوى الرقمي بفعالية.',
                'level' => 'مبتدئ',
                'image' => 'https://placehold.co/800x600/e9ecef/495057?text=Content+Marketing'
            ],
            [
                'title' => 'تحليلات جوجل المتقدمة',
                'description' => 'تعلم كيفية تحليل بيانات موقعك باستخدام Google Analytics.',
                'level' => 'متقدم',
                'image' => 'https://placehold.co/800x600/e9ecef/495057?text=Google+Analytics'
            ],
            [
                'title' => 'إدارة وسائل التواصل الاجتماعي',
                'description' => 'تعلم كيفية إدارة حسابات التواصل الاجتماعي للشركات.',
                'level' => 'متوسط',
                'image' => 'https://placehold.co/800x600/e9ecef/495057?text=Social+Media'
            ]
        ];

        // توزيع الدورات على المدربين
        foreach ($instructors as $instructor) {
            // كل مدرب سيكون لديه 2-3 دورات
            $numberOfCourses = rand(2, 3);
            
            for ($i = 0; $i < $numberOfCourses; $i++) {
                $course = $courses[array_rand($courses)];
                
                Course::create([
                    'title' => $course['title'] . ' - ' . $instructor->name,
                    'slug' => str_replace(' ', '-', strtolower(transliterator_transliterate('Any-Latin; Latin-ASCII', $course['title']))) . '-' . $instructor->id . '-' . $i,
                    'description' => $course['description'],
                    'price' => rand(499, 999),
                    'duration_in_weeks' => rand(4, 12),
                    'lectures_count' => rand(20, 60),
                    'level' => $course['level'],
                    'requirements' => 'لا يتطلب خبرة سابقة',
                    'what_you_will_learn' => 'ستتعلم في هذه الدورة المهارات الأساسية والمتقدمة',
                    'status' => Course::STATUS_PUBLISHED,
                    'image' => $course['image'],
                    'category_id' => $categories->random()->id,
                    'instructor_id' => $instructor->id
                ]);
            }
        }
    }
}
