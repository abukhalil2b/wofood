<?php

namespace Database\Seeders;

use App\Models\Group;

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            'الدعم الفني',
            'رئاسة البعثة',
            'الإفتاء والإرشاد الديني',
            'الإداري والمالي',
            'الإشراف على شركات الحج',
            'الطبي',
            'شرطة عمان السلطانية',
            'الإعلامي',
            'الكشفي',
        ];

        foreach ($titles as $title) {
            Group::create([
                'title' => $title
            ]);
        }
    }
}
