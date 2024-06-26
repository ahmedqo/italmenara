<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Section;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'admin@test.com',
            'phone' => '212999999999',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        foreach (['principal', 'business', 'shipping'] as $type) {
            Section::create(['type' => $type]);
        }

        foreach ([
            [
                'type' => 'currency',
                'group' => 'core',
                'content' => 'EURO'
            ], [
                'type' => 'period',
                'group' => 'core',
                'content' => 'week'
            ], [
                'type' => 'contact_email',
                'group' => 'contact',
                'content' => 'contact@italmenara.com'
            ], [
                'type' => 'print_email',
                'group' => 'print',
                'content' => 'print@italmenara.com'
            ], [
                'type' => 'print_phone',
                'group' => 'print',
                'content' => 'XXXXXXXXXX'
            ], [
                'type' => 'auto_quotation',
                'group' => 'auto',
                'content' => 'true'
            ], [
                'type' => 'auto_invoice',
                'group' => 'auto',
                'content' => 'true'
            ], [
                'type' => 'instagram',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'telegram',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'facebook',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'youtube',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'tiktok',
                'group' => 'social',
                'content' => ''
            ], [
                'type' => 'x',
                'group' => 'social',
                'content' => ''
            ],
        ] as $arr) {
            Setting::create($arr);
        }
    }
}
