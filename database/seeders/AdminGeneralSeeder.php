<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminGeneralSeeder extends Seeder
{
    public $listeRolesWithPermissions = [
        'ADMINISTRATEUR' => [
            'permissions' => [
                'create_user',
                'edit_user',
                'show_user_list',
                'lock_user',
                'index_type_composant',
                'create_type_composant',
                'update_type_composant',
                'delete_type_composant',
                'index_composant',
                'create_composant',
                'update_composant',
                'delete_composant',
                'index_pack',
                'create_pack',
                'update_pack',
                'delete_pack',
                'index_commande',
                'create_commande',
                'update_commande',
                'delete_commande',
                'delete_opération',
                'index_type_composant',
                'create_type_composant',
                'update_type_composant',
                'delete_type_composant',
                'index_source_commande',
                'create_source_commande',
                'update_source_commande',
                'delete_source_commande'
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
            $role =  Role::create(['name' => $key, 'libelle' => 'ADMINISTRATEUR']);
            foreach ($value['permissions'] as  $permission) {
                $permission = Permission::where('name', $permission)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
