<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Account;
use App\Models\Country;
use App\Models\Hierachie;
use App\Models\TypePiece;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AgentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'id' => Str::uuid(),
            'name' => 'SALANON',
            'firstname' => 'Richard',
            'email' => 'richard@gmail.com',
            'password' => Hash::make('123456789'),
            'phone' => '96857452',

        ]);

        $role = Role::where('name', '=', 'ADMINISTRATEUR')->first();
        $user->assignRole($role);
    }
}
