<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgentRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     $cuisine = [
        //         'id' => Str::uuid(),
        //         'nom' => 'PIERRE',
        //         'prenom' => 'poline',
        //         'email' => 'pierre@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '96857452',

        //     ];

        //     $cuisinier = User::create($cuisine);

        //     $rolecuisinier = Role::where('name', '=', 'CUISINIER')->first();
        //     $cuisinier->assignRole($rolecuisinier);


        //     $caisse = [
        //         'id' => Str::uuid(),
        //         'nom' => 'GNONLONFOUN',
        //         'prenom' => 'Jean',
        //         'email' => 'jean@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '98757457',

        //     ];

        //     $caissier = User::create($caisse);

        //     $rolecaissier = Role::where('name', '=', 'CAISSIER')->first();
        //     $caissier->assignRole($rolecaissier);



        //     $compte = [
        //         'id' => Str::uuid(),
        //         'nom' => 'AKUE',
        //         'prenom' => 'Precieux',
        //         'email' => 'precieux@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '66857452',

        //     ];

        //     $comptable = User::create($compte);

        //     $rolecomptable = Role::where('name', '=', 'COMPTABLE')->first();
        //     $comptable->assignRole($rolecomptable);



        //     $commerce = [
        //         'id' => Str::uuid(),
        //         'nom' => 'DOSSOU-YOVO',
        //         'prenom' => 'Fulbert',
        //         'email' => 'fulbert@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '55857452',

        //     ];

        //     $commercial = User::create($commerce);

        //     $rolecommercial= Role::where('name', '=', 'COMMERCIAL')->first();
        //     $commercial->assignRole($rolecommercial);


        //     $empack = [
        //         'id' => Str::uuid(),
        //         'nom' => 'AHOUANGBASSO',
        //         'prenom' => 'Philip',
        //         'email' => 'philip@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '98855452',

        //     ];

        //     $empaqueteur = User::create($empack);

        //     $roleempaqueteur= Role::where('name', '=', 'EMPAQUETEUR')->first();
        //     $empaqueteur->assignRole($roleempaqueteur);



        //     $direction = [
        //         'id' => Str::uuid(),
        //         'nom' => 'KPEGNON',
        //         'prenom' => 'Simonne',
        //         'email' => 'simonne@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '55857452',

        //     ];

        //     $directeur = User::create($direction);

        //     $roledirecteur = Role::where('name', '=', 'DIRECTEUR')->first();
        //     $directeur->assignRole($roledirecteur);


        //     $administration = [
        //         'id' => Str::uuid(),
        //         'nom' => 'AGBADJAGAN',
        //         'prenom' => 'Romualde',
        //         'email' => 'romualde@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '59857452',

        //     ];

        //     $administrateur = User::create($administration);

        //     $roleadministrateur = Role::where('name', '=', 'ADMINISTRATEUR')->first();
        //     $administrateur->assignRole($roleadministrateur);


        //     $resopération = [
        //         'id' => Str::uuid(),
        //         'nom' => 'MAHOUGNON',
        //         'prenom' => 'Judicael',
        //         'email' => 'judicael@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '58575522',

        //     ];

        //     $responsableopéra = User::create($resopération);

        //     $roleresponsableopéra = Role::where('name', '=', 'RESPONSABLE_DES_OPERATIONS')->first();
        //     $responsableopéra->assignRole($roleresponsableopéra);



        //     $chargeclient= [
        //         'id' => Str::uuid(),
        //         'nom' => 'GANDONOU',
        //         'prenom' => 'Marus',
        //         'email' => 'marus@gmail.com',
        //         'password' => Hash::make('123456789'),
        //         'phone' => '55897452',

        //     ];

        //     $chargeclientel = User::create($chargeclient);

        //     $rolechargeclientel = Role::where('name', '=', 'CHARGE_DE_CLIENTELE')->first();
        //     $chargeclientel->assignRole($rolechargeclientel);

        // $faker = \Faker\Factory::create();
        // $status = array(0, 1);
        // for ($i = 0; $i < 200; $i++) {
        //     $user[$i] =  User::create([
        //         'id' => Str::uuid(),
        //         'name' => $faker->lastName,
        //         'firstname' => $faker->firstName,
        //         'status' => $status[array_rand($status)],
        //         'deliver' => $status[array_rand($status)],
        //         'phone' => '+00229' . $faker->numerify('########'),
        //         'email' => $faker->unique()->email,
        //         'password' => Hash::make('123456789'),
        //     ]);
        // }


        // $allroles = Role::all();
        // $array = array();
        // foreach ($allroles as $rol) {
        //     array_push($array, $rol);
        // }
        // $users = User::where([['name', '!=', 'SALANON'],['firstname', '!=', 'Richard'], ['email', '!=', 'richard@gmail.com']])->get();

        // foreach ($users as $user) {
        //     $user->assignRole($array[array_rand($array)]);
        // }

        // $user = User::create([
        //     'id' => Str::uuid(),
        //     'name' => 'SALANON',
        //     'firstname' => 'Richard',
        //     'status' => 1,
        //     'deliver' => 0,
        //     'phone' => '+0022912345678',
        //     'email' => 'richard@gmail.com',
        //     'password' => Hash::make('123456789'),
        // ]);

        // $role = Role::where('name', '=', 'ADMINISTRATEUR')->first();
        // $user->assignRole($role);
    }
}
