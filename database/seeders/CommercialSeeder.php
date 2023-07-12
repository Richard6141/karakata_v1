<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommercialSeeder extends Seeder
{
    public $listeRolesWithPermissions = [
        'COMMERCIAL' => [
            'permissions' => [
                'index_commande',
                'create_commande',
                'update_commande',
                'delete_commande',
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
            $role =  Role::create(['name' => $key, 'libelle' => 'COMMERCIAL']);
            foreach ($value['permissions'] as  $permission) {
                $permission = Permission::where('name', $permission)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
