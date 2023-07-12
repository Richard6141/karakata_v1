<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = User::all();
        $user_id = [];
        foreach ($users as $user) {
            array_push($user_id, $user->id);
        }
        $date = str_replace('-', '', date('y-m-d'));
        $code = 'TF' . uniqid() . $date;
        $prices = Array(2500,3500,10000);
        $status = Array(0, 1);
        $customers = Customer::all();
        $customer_id = [];
        foreach ($customers as $customer) {
            array_push($customer_id, $customer->id);
        }
        for ($i = 0; $i < 100; $i++) {
            $coupon[$i] = Coupon::create(['id' => Str::uuid(), 'coupon_unique_code' => 'TF' . uniqid() . $date, 'coupon_value' => $prices[array_rand($prices)], 'issue_date' => $faker->dateTimeBetween('now', '+2 months'), 'expiry_date' => $faker->dateTimeBetween('now', '+4 months'), 'coupon_status' => $status[array_rand($status)], 'created_by' => $user_id[array_rand($user_id)], 'customer_id' => $customer_id[array_rand($customer_id)]]);
        }
    }
}
