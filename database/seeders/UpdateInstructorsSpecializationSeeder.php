<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\Specialization;
use Illuminate\Database\Seeder;

class UpdateInstructorsSpecializationSeeder extends Seeder
{
    public function run()
    {
        // Get all instructors without a specialization
        $instructors = Instructor::whereNull('specialization_id')->get();
        
        // Get a default specialization or create one if none exists
        $defaultSpecialization = Specialization::firstOrCreate(
            ['slug' => 'general'],
            [
                'name' => 'تخصص عام',
                'description' => 'تخصص عام للمدربين',
                'is_active' => true,
                'sort_order' => 999,
            ]
        );

        // Update all instructors without a specialization
        foreach ($instructors as $instructor) {
            $instructor->update(['specialization_id' => $defaultSpecialization->id]);
        }
    }
}
