<?php

namespace Database\Factories;

use App\Models\AddressBook;
use App\Models\Pack;
use App\Models\ModePaiement;
use App\Models\CarnetAdresse;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Paquet;
use App\Models\PayementMode;
use App\Models\Source;
use App\Models\SourceCommande;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commandes>
 */
class CommandesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ville = [
            'Cotonou',
            'Abomey-Calavi',
            'Porto-Novo',
            'Parakou',
            'Djougou',
            'Bohicon',
            'Natitingou',
            'Comè',
            'Allada',
        ];
        $statut_commande = [
            true,
            false,

        ];
        $statut_livraison = [
            true,
            false,
        ];

        $pack = Paquet::orderBy('id', 'DESC')->pluck('id');
        $carnet_adresse_id = AddressBook::orderBy('id', 'DESC')->pluck('id');
        $source_commande_id = Source::orderBy('id', 'DESC')->pluck('id');
        $mode_paiement_id = PayementMode::orderBy('id', 'DESC')->pluck('id');
        $client = Customer::orderBy('id', 'DESC')->pluck('id');

        return [
            'date' => now(),
            'nbr' => $this->faker->numberBetween($min = 1, $max = 100),
            'total' => $this->faker->numberBetween($min = 1500, $max = 100000),
            'pu' => $this->faker->numberBetween($min = 50, $max = 100),
            'description_localisation' => $this->faker->randomElement($ville),
            'statut_commande' => $this->faker->randomElement($statut_commande),
            'statut_livraison' => $this->faker->randomElement($statut_livraison),
            'commentaire' => $this->faker->sentence,
            'pack_id' => $this->faker->randomElement($pack),
            'client_id' => $this->faker->randomElement($client),
            'carnet_adresse_id' => $this->faker->randomElement($carnet_adresse_id),
            'source_commande_id' => $this->faker->randomElement($source_commande_id),
            'mode_paiement_id' => $this->faker->randomElement($mode_paiement_id),
            'created_at' => now(),
        ];
    }
}
