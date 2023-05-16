<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
            $group = Group::create([
                'title' => $title
            ]);
            //user_type	phone	name	idcard	password	group_id
            User::create([
                'user_type' => 'admin',
                'phone' => $group->id,
                'name' => $title,
                'password' => Hash::make($group->id),
                'group_id' => $group->id,
            ]);
        }
    }
}
