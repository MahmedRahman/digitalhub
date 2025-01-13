<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'التسويق الرقمي',
                'slug' => 'digital-marketing',
                'description' => 'دورات في التسويق الرقمي وإدارة الحملات الإعلانية عبر الإنترنت'
            ],
            [
                'name' => 'وسائل التواصل الاجتماعي',
                'slug' => 'social-media-marketing',
                'description' => 'تعلم إدارة حسابات التواصل الاجتماعي واستراتيجيات التسويق عبر المنصات المختلفة'
            ],
            [
                'name' => 'تسويق المحتوى',
                'slug' => 'content-marketing',
                'description' => 'دورات في كتابة المحتوى التسويقي وإنشاء استراتيجيات المحتوى'
            ],
            [
                'name' => 'إعلانات جوجل',
                'slug' => 'google-ads',
                'description' => 'تعلم إدارة حملات جوجل الإعلانية وتحسين معدل التحويل'
            ],
            [
                'name' => 'تحسين محركات البحث',
                'slug' => 'seo',
                'description' => 'دورات في تحسين الموقع لمحركات البحث وزيادة الظهور في نتائج البحث'
            ],
            [
                'name' => 'التسويق عبر البريد الإلكتروني',
                'slug' => 'email-marketing',
                'description' => 'تعلم استراتيجيات التسويق عبر البريد الإلكتروني وبناء قوائم المشتركين'
            ],
            [
                'name' => 'تحليلات التسويق',
                'slug' => 'marketing-analytics',
                'description' => 'دورات في تحليل البيانات التسويقية وقياس أداء الحملات'
            ],
            [
                'name' => 'التجارة الإلكترونية',
                'slug' => 'ecommerce',
                'description' => 'تعلم أساسيات التجارة الإلكترونية واستراتيجيات البيع عبر الإنترنت'
            ],
            [
                'name' => 'العلامة التجارية',
                'slug' => 'branding',
                'description' => 'دورات في بناء وتطوير العلامة التجارية عبر الإنترنت'
            ],
            [
                'name' => 'التسويق بالعمولة',
                'slug' => 'affiliate-marketing',
                'description' => 'تعلم أساسيات التسويق بالعمولة وبناء شبكة التسويق الخاصة بك'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
