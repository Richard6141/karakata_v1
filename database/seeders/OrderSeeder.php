<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Paquet;
use App\Models\Source;
use App\Models\Customer;
use App\Models\District;
use App\Models\AddressBook;
use App\Models\Deliver;
use App\Models\PaquetType;
use App\Models\PayementMode;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        for ($i = 0; $i < 20; $i++) {
            $number = $faker->numberBetween($min = 1000, $max = 3000);
            $unit_price = $faker->randomElement([
                '2500',
                '3500',
                '1500'
            ]);
            $addressbook = AddressBook::orderBy('id', 'ASC')->pluck('id');
            $source = Source::orderBy('id', 'ASC')->pluck('id');
            $district = District::orderBy('id', 'ASC')->pluck('id');
            $users = User::orderBy('id', 'asc')->pluck('id');
            $customers = Customer::orderBy('id', 'asc')->pluck('id');
            $paquette = Paquet::orderBy('id', 'asc')->pluck('id');
            $payementmode = PayementMode::orderBy('id', 'asc')->pluck('id');
            $order[$i] = Order::create([
                'id' => Str::uuid(),
                'date' => date('Y-m-d'),
                'number' => $faker->numberBetween($min = 1, $max = 10),
                'unit_price' => $faker->numberBetween($min = 1000, $max = 3000),
                'total' => $number * $unit_price,
                'slip_number' => $faker->numerify('########'),
                'address_book_id' => $faker->randomElement($addressbook),
                'source_id' => $faker->randomElement($source),
                'district_id' => $faker->randomElement($district),
                'created_by' => $faker->randomElement($users),
                'customer_id' => $faker->randomElement($customers),
                'finished' => $faker->randomElement([true, false]),
                'payement_mode_id' => $faker->randomElement($payementmode),
                'customer_delivery_time' => $faker->time($format = 'H:i', $min = '12:00', $max = '16:00'),
                'paquet_id' => $faker->randomElement($paquette),
                // 'created_at' => $faker->dateTimeBetween(now())
            ]);
        }
    }
}
