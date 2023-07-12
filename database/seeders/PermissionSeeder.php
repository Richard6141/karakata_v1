<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* DB::table('permissions')->insert([
            [
                'name' => 'index_user',
                'guard_name'=>'web',
                'libelle'=>'Liste des agents',
            ],
        ]); */



        DB::table('permissions')->insert([
            [
                'name' => 'show_user_list',
                'guard_name'=>'web',
                'libelle'=>'Liste des agents',
            ],
            [
                'name' => 'create_user',
                'guard_name'=>'web',
                'libelle'=>'Création d\'un agent',
            ],
            [
                'name' => 'edit_user',
                'guard_name'=>'web',
                'libelle'=>'Modification d\'un agent',
            ],
            [
                'name' => 'lock_user',
                'guard_name'=>'web',
                'libelle'=>'Activation d\'un agent',
            ],
            [
                'name' => 'index_type_composant',
                'guard_name'=>'web',
                'libelle'=>'Liste des types composants',
            ],
            [
                'name' => 'create_type_composant',
                'guard_name'=>'web',
                'libelle'=>'Création d\'un type composant',
            ],
            [
                'name' => 'update_type_composant',
                'guard_name'=>'web',
                'libelle'=>'Modification d\'un type composant',
            ],
            [
                'name' => 'delete_type_composant',
                'guard_name'=>'web',
                'libelle'=>'Suppression d\'un type composant',
            ],
            [
                'name' => 'index_composant',
                'guard_name'=>'web',
                'libelle'=>'Liste des composants',
            ],
            [
                'name' => 'create_composant',
                'guard_name'=>'web',
                'libelle'=>'Création d\'un composant',
            ],
            [
                'name' => 'update_composant',
                'guard_name'=>'web',
                'libelle'=>'Modification d\'un composant',
            ],
            [
                'name' => 'delete_composant',
                'guard_name'=>'web',
                'libelle'=>'Suppression d\'un composant',
            ],
            [
                'name' => 'index_pack',
                'guard_name'=>'web',
                'libelle'=>'Liste des packs',
            ],
            [
                'name' => 'create_pack',
                'guard_name'=>'web',
                'libelle'=>'Création d\'un pack',
            ],
            [
                'name' => 'update_pack',
                'guard_name'=>'web',
                'libelle'=>'Modification d\'un pack',
            ],
            [
                'name' => 'delete_pack',
                'guard_name'=>'web',
                'libelle'=>'Suppression d\'un pack',
            ],
            [
                'name' => 'index_commande',
                'guard_name'=>'web',
                'libelle'=>'Liste des commandes',
            ],
            [
                'name' => 'create_commande',
                'guard_name'=>'web',
                'libelle'=>'Création d\'une commande',
            ],
            [
                'name' => 'update_commande',
                'guard_name'=>'web',
                'libelle'=>'Modification d\'une commande',
            ],
            [
                'name' => 'delete_commande',
                'guard_name'=>'web',
                'libelle'=>'Suppression d\'une commande',
            ],
            [
                'name' => 'index_source_commande',
                'guard_name'=>'web',
                'libelle'=>'Liste des sources commande',
            ],
            [
                'name' => 'create_source_commande',
                'guard_name'=>'web',
                'libelle'=>'Création d\'une source commande',
            ],
            [
                'name' => 'update_source_commande',
                'guard_name'=>'web',
                'libelle'=>'Modification d\'une source commande',
            ],
            [
                'name' => 'delete_source_commande',
                'guard_name'=>'web',
                'libelle'=>'Suppression d\'une source commande',
            ],
            [
                'name' => 'delete_operation',
                'guard_name'=>'web',
                'libelle'=>'Suppression d\'une operation',
            ],
        ]);
    }
}
