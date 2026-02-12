<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('channels')->insert([
            ['content' => '自社サイト', 'created_at' => now(), 'updated_at' => now()],
            ['content' => '検索エンジン', 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'SNS', 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'テレビ・新聞', 'created_at' => now(), 'updated_at' => now()],
            ['content' => '友人・知人', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
