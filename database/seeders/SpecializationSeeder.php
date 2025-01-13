<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecializationSeeder extends Seeder
{
    public function run(): void
    {
        $specializations = [
            [
                'name' => 'التسويق الرقمي',
                'description' => 'استراتيجيات التسويق عبر المنصات الرقمية ووسائل التواصل الاجتماعي',
                'icon' => 'fas fa-bullhorn',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'تسويق المحتوى',
                'description' => 'إنشاء وإدارة المحتوى التسويقي الفعال للعلامات التجارية',
                'icon' => 'fas fa-pencil-alt',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'إدارة وسائل التواصل الاجتماعي',
                'description' => 'إدارة حسابات العلامات التجارية على منصات التواصل الاجتماعي',
                'icon' => 'fas fa-share-alt',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'تحليلات التسويق',
                'description' => 'تحليل البيانات وقياس أداء الحملات التسويقية',
                'icon' => 'fas fa-chart-line',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'تسويق البريد الإلكتروني',
                'description' => 'تصميم وتنفيذ حملات البريد الإلكتروني التسويقية',
                'icon' => 'fas fa-envelope',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'إعلانات مدفوعة',
                'description' => 'إدارة الحملات الإعلانية المدفوعة على مختلف المنصات',
                'icon' => 'fas fa-ad',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($specializations as $specialization) {
            $specialization['slug'] = Str::slug($specialization['name']);
            Specialization::create($specialization);
        }
    }
}
