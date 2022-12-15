<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buyer;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buyers = [
            [
                'name'           => 'Dens Corp.',
                'email'          => 'densg@mail.com',
                'contact_number'          => '09123456789',
                'location'          => 'Cagayan de oro',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ];

        Buyer::insert($buyers);
    }
}
