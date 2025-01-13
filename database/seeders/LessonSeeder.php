<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            // عدد عشوائي من الدروس لكل كورس (6-12 درس)
            $numberOfLessons = rand(6, 12);

            // إنشاء دروس تمهيدية مجانية
            $this->createLesson($course, [
                'title' => 'مقدمة الدورة والتعريف بالمحتوى',
                'description' => 'نظرة عامة على محتوى الدورة وما سيتم تعلمه',
                'is_free' => true,
                'order' => 1,
            ]);

            $this->createLesson($course, [
                'title' => 'كيفية الاستفادة القصوى من الدورة',
                'description' => 'إرشادات وتوجيهات للاستفادة المثلى من محتوى الدورة',
                'is_free' => true,
                'order' => 2,
            ]);

            // إنشاء باقي الدروس
            for ($i = 3; $i <= $numberOfLessons; $i++) {
                $this->createLesson($course, [
                    'title' => "الدرس {$i}: " . $this->getLessonTitle($course, $i),
                    'description' => $this->getLessonDescription($course, $i),
                    'is_free' => false,
                    'order' => $i,
                ]);
            }
        }
    }

    private function createLesson($course, $data)
    {
        $duration = rand(5, 45); // مدة عشوائية بين 5 و 45 دقيقة
        
        return Lesson::create([
            'course_id' => $course->id,
            'title' => $data['title'],
            'slug' => Str::slug($data['title']) . '-' . Str::random(6), // إضافة رقم عشوائي للسلاج
            'description' => $data['description'],
            'content' => $this->generateContent(),
            'video_url' => 'https://example.com/videos/' . Str::random(10),
            'video_duration' => "{$duration}:00",
            'order' => $data['order'],
            'is_free' => $data['is_free'],
            'is_published' => true,
            'resources' => [
                'presentation' => 'presentation.pdf',
                'exercise_files' => 'exercise.zip',
                'additional_reading' => 'reading.pdf',
            ],
            'attachments' => [
                'worksheet' => 'worksheet.pdf',
                'code_samples' => 'code.zip',
            ],
        ]);
    }

    private function getLessonTitle($course, $i)
    {
        $marketingLessonTitles = [
            'مفاهيم أساسية في التسويق الرقمي',
            'تحليل السوق المستهدف',
            'بناء استراتيجية التسويق',
            'إنشاء المحتوى التسويقي',
            'إدارة وسائل التواصل الاجتماعي',
            'تحسين محركات البحث SEO',
            'إعلانات جوجل المدفوعة',
            'التسويق عبر البريد الإلكتروني',
            'تحليل البيانات والأداء',
            'استراتيجيات التسويق المتقدمة',
        ];

        return $marketingLessonTitles[array_rand($marketingLessonTitles)];
    }

    private function getLessonDescription($course, $i)
    {
        $descriptions = [
            'في هذا الدرس سنتعرف على المفاهيم الأساسية وكيفية تطبيقها عملياً',
            'سنتعلم كيفية تحليل السوق واستهداف الجمهور المناسب',
            'خطوات عملية لبناء استراتيجية تسويقية ناجحة',
            'أساليب وتقنيات إنشاء محتوى جذاب ومؤثر',
            'كيفية إدارة حسابات التواصل الاجتماعي باحترافية',
            'تعلم أساسيات وتقنيات تحسين محركات البحث',
            'إنشاء وإدارة حملات إعلانية ناجحة',
            'استراتيجيات التسويق عبر البريد الإلكتروني',
            'تحليل وقياس نتائج الحملات التسويقية',
            'تقنيات وأدوات متقدمة في التسويق الرقمي',
        ];

        return $descriptions[array_rand($descriptions)];
    }

    private function generateContent()
    {
        return "# محتوى الدرس\n\n" .
               "## المقدمة\n" .
               "في هذا الدرس سنتعلم المفاهيم الأساسية والتطبيقات العملية.\n\n" .
               "## النقاط الرئيسية\n" .
               "1. المفهوم الأساسي\n" .
               "2. الخطوات العملية\n" .
               "3. أفضل الممارسات\n" .
               "4. نصائح وإرشادات\n\n" .
               "## التطبيق العملي\n" .
               "سنقوم بتطبيق ما تعلمناه من خلال مثال عملي.\n\n" .
               "## الملخص\n" .
               "مراجعة سريعة لأهم النقاط التي تم تغطيتها في الدرس.\n\n" .
               "## المراجع والمصادر\n" .
               "- المصدر الأول\n" .
               "- المصدر الثاني\n" .
               "- المصدر الثالث";
    }
}
