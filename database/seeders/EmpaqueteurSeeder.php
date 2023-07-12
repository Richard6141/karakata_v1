<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmpaqueteurSeeder extends Seeder
{
    public $listeRolesWithPermissions = [
        'EMPAQUETEUR' => [
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
            $role =  Role::create(['name' => $key, 'libelle' => 'EMPAQUETEUR']);
            foreach ($value['permissions'] as  $permission) {
                $permission = Permission::where('name', $permission)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
