<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1: 固定ダミーユーザーを作成（レビュワー向けの固定情報）
        $user = User::factory()->create([
            'name' => 'Dummy User',
            'email' => 'dummy@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2: weight_logs を 35 件作成して user_id を紐づけ
        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);

        // 3: weight_target を 1 件作成して user_id を紐づけ（current_weight を追加）
        WeightTarget::factory()->create([
            'user_id' => $user->id,
            'target_weight' => 55.0,
            'current_weight' => 62.5,
        ]);
    }
}
