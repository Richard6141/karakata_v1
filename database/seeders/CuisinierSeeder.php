<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CuisinierSeeder extends Seeder
{
    public $listeRolesWithPermissions = [
        'CUISINIER' => [
            'permissions' => [
                'index_type_composant',
                'create_type_composant',
                'update_type_composant',
                'delete_type_composant',
                'index_composant',
                'create_composant',
                'update_composant',
                'delete_composant',
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
            $role =  Role::create(['name' => $key, 'libelle' => 'CUISINIER']);
            foreach ($value['permissions'] as  $permission) {
                $permission = Permission::where('name', $permission)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
