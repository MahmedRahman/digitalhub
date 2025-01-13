<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InstructorSeeder extends Seeder
{
    public function run()
    {
        // قائمة بالأسماء العربية
        $arabicNames = [
            'أحمد محمد', 'سارة أحمد', 'محمد علي', 'فاطمة حسن', 'عمر خالد',
            'نور محمد', 'علي أحمد', 'ريم عبدالله', 'خالد إبراهيم', 'منى سعيد',
            'يوسف محمود', 'ليلى عمر', 'حسن علي', 'رنا محمد', 'عبدالله أحمد',
            'سلمى خالد', 'طارق محمد', 'هدى علي', 'كريم أحمد', 'دينا محمود'
        ];

        $specializations = Specialization::all();

        foreach ($arabicNames as $index => $name) {
            $instructor = Instructor::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'phone' => '+20' . rand(1000000000, 1999999999),
                'title' => 'خبير تسويق رقمي ومدرب معتمد',
                'bio' => 'خبير في مجال التسويق الرقمي مع أكثر من 5 سنوات من الخبرة في تدريب وتطوير المهارات الرقمية.',
                'experience' => rand(3, 10) . '+ سنوات في التسويق الرقمي والتدريب',
                'facebook' => 'https://facebook.com/' . strtolower(str_replace(' ', '.', $name)),
                'twitter' => 'https://twitter.com/' . strtolower(str_replace(' ', '.', $name)),
                'linkedin' => 'https://linkedin.com/in/' . strtolower(str_replace(' ', '.', $name)),
                'website' => 'https://' . strtolower(str_replace(' ', '', $name)) . '.com',
                'status' => Instructor::STATUS_ACTIVE,
                'specialization_id' => $specializations->random()->id
            ]);

            // Assign 2-3 random specializations to each instructor
            $randomSpecializations = $specializations->random(rand(2, 3));
            $instructor->specializations()->attach($randomSpecializations->pluck('id')->toArray());
        }

        // نسخ الصور الافتراضية إلى مجلد التخزين العام
        $defaultImagesPath = storage_path('app/public/instructors');
        if (!File::exists($defaultImagesPath)) {
            File::makeDirectory($defaultImagesPath, 0755, true);
        }

        // نسخ 5 صور افتراضية
        for ($i = 1; $i <= 5; $i++) {
            $sourcePath = database_path('seeders/images/instructor' . $i . '.jpg');
            $targetPath = storage_path('app/public/instructors/instructor' . $i . '.jpg');
            if (File::exists($sourcePath)) {
                File::copy($sourcePath, $targetPath);
            }
        }
    }
}
