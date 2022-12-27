<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Item;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'ADMIN',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$zPiaTbYwkxYcejFmEimhWedeAogTJvEb/yGmBVx390ihhPFy8r896',
                'remember_token' => null,
            ],
        ];
        $types = [
            [
                'title'           => 'Paper',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'           => 'Bottle Glass',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'           => 'Aluminum',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];


        $units = [
            [
                'title'           => 'Kgs',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'           => 'Pcs',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'           => 'G',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        $items = [
            [
                'title'             => 'Magazine',
                'type_id'           => '1',
                'buying_price'             => 10,
                'selling_price'             => 15,
                'unit_id'           => '1',
                'description'       => 'TEST ITEM',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'             => 'Tuanduay',
                'type_id'           => '2',
                'buying_price'             => 2,
                'selling_price'             => 5,
                'unit_id'           => '2',
                'description'       => 'TEST ITEM',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'title'             => 'Aluminum',
                'type_id'           => '3',
                'buying_price'             => 100,
                'selling_price'             => 105,
                'unit_id'           => '3',
                'description'       => 'TEST ITEM',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        User::insert($users);
        Type::insert($types);
        Unit::insert($units);
        Item::insert($items);
    }
}
