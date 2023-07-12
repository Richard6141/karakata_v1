<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CaissierSeeder extends Seeder
{
    public $listeRolesWithPermissions = [
        'CAISSIER' => [
            'permissions' => [
            ]
        ]
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->listeRolesWithPermissions as $key => $value) {
            $role =  Role::create(['name' => $key, 'libelle' => 'CAISSIER']);
            foreach ($value['permissions'] as  $permission) {
                $permission = \Spatie\Permission\Models\Permission::where('name', $permission)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
