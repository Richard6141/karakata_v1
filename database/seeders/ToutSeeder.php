<?php

namespace Database\Seeders;

use App\Models\Composants;
use App\Models\Pack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type_composants;

class ToutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_composants = array(
            array('id' => '0293b10b-cc79-446d-a7dc-f537edb67f44', 'labels' => 'Résistance', 'created_by' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '04b1ce76-1cef-4c7c-83f2-cfb99b445bba', 'labels' => 'Boisson', 'created_by' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '4c73f051-73d8-4b65-96c5-82579b4672d0', 'labels' => 'Dessert', 'created_by' => NULL, 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => 'b56a879f-aad9-405c-b0fe-1e3299e4d388', 'labels' => 'Accompagnement', 'created_by' => NULL, 'created_at' => NULL, 'updated_at' => NULL)
        );

        foreach ($type_composants as $item) {
            Type_composants::create([
                'id' => $item['id'],
                'labels' => $item['labels'],
            ]);
        }


        $packs = array(
            array('id' => '0611648d-74aa-4dea-9e74-1050404c6dd8', 'label' => 'Salade diner Pack', 'price' => '4000', 'nbr_composant' => NULL, 'image' => 'image1.jpeg', 'status' => '0', 'created_by' => NULL, 'created_at' => '2022-08-18 11:38:52', 'updated_at' => '2022-08-18 11:38:52'),
            array('id' => '202178db-cdea-47ce-95f7-5cfea38da7a4', 'label' => 'Interne Pack', 'price' => '1500', 'nbr_composant' => NULL, 'image' => 'image1.jpeg', 'status' => '1', 'created_by' => NULL, 'created_at' => '2022-08-18 11:38:52', 'updated_at' => '2022-08-18 14:53:30'),
            array('id' => '517532df-6a4b-4e4c-bbb4-aa5d8351695a', 'label' => 'Birthday Pack', 'price' => '3000', 'nbr_composant' => NULL, 'image' => 'image1.jpeg', 'status' => '1', 'created_by' => NULL, 'created_at' => '2022-08-18 11:38:52', 'updated_at' => '2022-08-18 14:53:17'),
            array('id' => 'b60ce2f2-8538-4057-b5e5-37209868cb6d', 'label' => 'Small Pack', 'price' => '2500', 'nbr_composant' => NULL, 'image' => 'image1.jpeg', 'status' => '0', 'created_by' => NULL, 'created_at' => '2022-08-18 11:38:52', 'updated_at' => '2022-08-18 11:38:52'),
            array('id' => 'cb9971d0-9262-4073-84a0-de18064bc7f1', 'label' => 'Standard Pack', 'price' => '3500', 'nbr_composant' => NULL, 'image' => 'image1.jpeg', 'status' => '0', 'created_by' => NULL, 'created_at' => '2022-08-18 11:38:52', 'updated_at' => '2022-08-18 11:38:52')
        );

        foreach ($packs as $item) {
            Pack::create([
                'id' => $item['id'],
                'label' => $item['label'],
                'price' => $item['price'],
                'nbr_composant' => $item['nbr_composant'],
                'image' => $item['image'],
                'status' => $item['status'],
                'created_by' => $item['created_by'],
            ]);
        }


        $composants = array(
            array('id' => '462307d0-5b00-4495-98be-4322ebb6dafd', 'labels' => 'Poulet braisé + riz au gras aux petits pois', 'description' => 'poulet braisé', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '0293b10b-cc79-446d-a7dc-f537edb67f44', 'pack_id' => 'b60ce2f2-8538-4057-b5e5-37209868cb6d', 'created_by' => NULL, 'created_at' => '2022-08-26 14:07:40', 'updated_at' => '2022-08-18 14:07:40'),
            array('id' => '4cbd3d2a-1522-4a63-b648-bee429ad225b', 'labels' => 'Dakouin', 'description' => 'Dakouin', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '0293b10b-cc79-446d-a7dc-f537edb67f44', 'pack_id' => '517532df-6a4b-4e4c-bbb4-aa5d8351695a', 'created_by' => NULL, 'created_at' => '2022-08-18 14:20:33', 'updated_at' => '2022-08-26 14:20:33'),
            array('id' => '5a6a6c7a-d374-494e-a378-6f46634ad009', 'labels' => 'Jardinière de légume', 'description' => 'jardinière de légume', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => 'b56a879f-aad9-405c-b0fe-1e3299e4d388', 'pack_id' => 'cb9971d0-9262-4073-84a0-de18064bc7f1', 'created_by' => NULL, 'created_at' => '2022-08-26 12:02:20', 'updated_at' => '2022-08-18 12:02:20'),
            array('id' => '6c36b75d-5d95-4288-9734-aed2621e88a6', 'labels' => 'Poulet braisé + riz au gras aux petits pois', 'description' => 'poulet braisé', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '0293b10b-cc79-446d-a7dc-f537edb67f44', 'pack_id' => '517532df-6a4b-4e4c-bbb4-aa5d8351695a', 'created_by' => NULL, 'created_at' => '2022-08-26 14:18:25', 'updated_at' => '2022-08-18 14:18:25'),
            array('id' => 'a34dc5c4-0141-49a7-92ee-36ddc7f41507', 'labels' => 'Yaout nature', 'description' => 'yaout nature', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '4c73f051-73d8-4b65-96c5-82579b4672d0', 'pack_id' => '517532df-6a4b-4e4c-bbb4-aa5d8351695a', 'created_by' => NULL, 'created_at' => '2022-08-26 14:24:32', 'updated_at' => '2022-08-18 14:24:32'),
            array('id' => 'c4da1411-8a21-4b65-93cf-91742794c7c4', 'labels' => 'Salade de fruits', 'description' => 'salade de fruits', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '4c73f051-73d8-4b65-96c5-82579b4672d0', 'pack_id' => 'cb9971d0-9262-4073-84a0-de18064bc7f1', 'created_by' => NULL, 'created_at' => '2022-08-26 11:59:39', 'updated_at' => '2022-08-18 11:59:39'),
            array('id' => 'cc9e057e-0341-4b39-abfd-0639d6b73559', 'labels' => 'Citronnade', 'description' => 'citronnade', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '04b1ce76-1cef-4c7c-83f2-cfb99b445bba', 'pack_id' => 'cb9971d0-9262-4073-84a0-de18064bc7f1', 'created_by' => NULL, 'created_at' => '2022-08-26 11:45:44', 'updated_at' => '2022-08-18 11:45:44'),
            array('id' => 'ccef6526-1358-499b-882d-818f6f27b0ee', 'labels' => 'Orange-gingembre', 'description' => 'orange-gingembre', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '04b1ce76-1cef-4c7c-83f2-cfb99b445bba', 'pack_id' => '517532df-6a4b-4e4c-bbb4-aa5d8351695a', 'created_by' => NULL, 'created_at' => '2022-08-26 14:22:13', 'updated_at' => '2022-08-18 14:22:13'),
            array('id' => 'e95b3770-16f3-467f-8dae-dde78f7e68a5', 'labels' => 'Sauce sésame poisson et wagashi + télibo', 'description' => 'sauce sésame poisson', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '0293b10b-cc79-446d-a7dc-f537edb67f44', 'pack_id' => 'cb9971d0-9262-4073-84a0-de18064bc7f1', 'created_by' => NULL, 'created_at' => '2022-08-26 11:53:43', 'updated_at' => '2022-08-18 11:53:43'),
            array('id' => 'ebd52832-b3d5-4541-9d29-587b26d33cdb', 'labels' => 'Viande de mouton + cassoulet et riz', 'description' => 'viande', 'image' => '2022-08-18 14 07 40pilon de poulet braise.jpeg', 'status' => '0', 'publish_date' => date('Y-m-d'), 'type_composant_id' => '0293b10b-cc79-446d-a7dc-f537edb67f44', 'pack_id' => 'cb9971d0-9262-4073-84a0-de18064bc7f1', 'created_by' => NULL, 'created_at' => '2022-08-26 11:48:12', 'updated_at' => '2022-08-18 11:48:12')
        );

        foreach ($composants as $item) {
            Composants::create([
                'id' => $item['id'],
                'labels' => $item['labels'],
                'description' => $item['description'],
                'image' => $item['image'],
                'status' => $item['status'],
                'publish_date' => $item['publish_date'],
                'type_composant_id' => $item['type_composant_id'],
                'pack_id' => $item['pack_id'],
                'created_by' => $item['created_by'],
            ]);
        }
    }
}
