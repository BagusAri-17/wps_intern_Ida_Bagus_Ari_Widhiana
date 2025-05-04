<?php

namespace Database\Seeders;

use App\Models\DetailUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $detail_users = [
            [
                'user_id'           => 1,
                'position_id'       => 1,
                'manage_by'         => 1,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],
            [
                'user_id'           => 2,
                'position_id'       => 2,
                'manage_by'         => 1,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],
            [
                'user_id'           => 3,
                'position_id'       => 3,
                'manage_by'         => 2,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],
            [
                'user_id'           => 4,
                'position_id'       => 4,
                'manage_by'         => 1,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],
            [
                'user_id'           => 5,
                'position_id'       => 5,
                'manage_by'         => 4,
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s'),
            ],
        ];

        DetailUser::insert($detail_users);
    }
}
