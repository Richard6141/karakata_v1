<?php

namespace Database\Seeders;

use App\Models\AddressBook;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = User::orderBy('id', 'asc')->pluck('id');
        $customers = Customer::orderBy('id', 'asc')->pluck('id');
        for ($i = 0; $i <100; $i++) {
            $Addressbook[$i] = AddressBook::create([
                'id' => Str::uuid(),
                'address' => $faker->streetName(),
                'created_by' => $faker->randomElement($users),
                'customer_id' => $faker->randomElement($customers),
                'receiver_id' => null,
            ]);
        }
    }
}
