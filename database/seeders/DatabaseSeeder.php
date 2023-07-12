<?php

namespace Database\Seeders;

use App\Models\Commandes;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GestionnaireStockSeeder::class,
            PermissionSeeder::class,
            AdminGeneralSeeder::class,
            AgentSeeder::class,
            UniteSeeder::class,
            TypeOfOperationSeeder::class,
            ProduitSeeder::class,
            TypeComposantSeeder::class,
            TypepackSeeder::class,
            PackSeeder::class,
            ComposantSeeder::class,
            ClientSeeder::class,
            CouponSeeder::class,
            DeliverSeeder::class,
            CuisinierSeeder::class,
            CommercialSeeder::class,
            ChargeClienteleSeeder::class,
            ComptableSeeder::class,
            CaissierSeeder::class,
            DirecteurSeeder::class,
            RespOperrationSeeder::class,
            EmpaqueteurSeeder::class,
            AgentRoleSeeder::class,
            AddressbookSeeder::class,
            sourceSeeder::class,
            PaymentModeSeeder::class,
            districSeeder::class,
            ordertypeSeeder::class,
            OrderSeeder::class,

            //
            //
            //     ModePayementSeeder::class,
            //     SourceCommandeSeeder::class,
                // TypeCommandeSeeder::class,
            //
            //     //ToutSeeder::class,
            //     CuisineSeeder::class,
            //     // EtatSeeder::class,
            //     // DomaineSeeder::class,
            //     PackSeeder::class,
            // SuggestionSeeder::class,
            //     // ProduitSeeder::class,
            // OperationSeeder::class,
        ]);
        // Order::factory()->count(10)->create();
    }
}
