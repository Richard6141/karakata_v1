<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Categorie;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Particular;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use SebastianBergmann\Type\FalseType;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $particuliers = [
            [
                'id' => Str::uuid(),
                'name' => 'BABADAHO',
                'firstname' => 'jean',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'AVLESSI',
                'firstname' => 'Odilon',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'SEMAKO',
                'firstname' => 'Fidelia',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'MANNOU',
                'firstname' => 'Felicien',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'SIKA',
                'firstname' => 'Cézar',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'SANGBO',
                'firstname' => 'Alexis',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'GANBO',
                'firstname' => 'victor',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'AYLA',
                'firstname' => 'David',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'ADJOVI',
                'firstname' => 'Eric',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'OLOUWA',
                'firstname' => 'Fèmi',

            ],
        ];
        $entreprises = [
            [
                'id' => Str::uuid(),
                'name' => 'AHISSOU',
                'firstname' => 'Xavier',
                'socialreason'=> 'UBA',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ADEOSSI',
                'firstname' => 'Pacôme',
                'socialreason'=> 'MOOV',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'ADECHOLA',
                'firstname' => 'Ayemi',
                'socialreason'=> 'MTN',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'BOCCOSSA',
                'firstname' => 'Merveille',
                'socialreason'=> 'SOBEBRA',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'HOUSSOU',
                'firstname' => 'Gabriella',
                'socialreason'=> 'SONACOP',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'AMATE',
                'firstname' => 'Calos',
                'socialreason'=> 'BGFI',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'NOUKPO',
                'firstname' => 'Ines',
                'socialreason'=> 'SBEE',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'AZIZA',
                'firstname' => 'Kelvin',
                'socialreason'=> 'SOBEBRA',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'SAGBOHAN',
                'firstname' => 'Eric',
                'socialreason'=> 'SOBEBRA',

            ],
            [
                'id' => Str::uuid(),
                'name' => 'MINKPE',
                'firstname' => 'Rodolph',
                'socialreason' => 'Ambassade de France',

            ],
        ];

        foreach ($particuliers as $key => $value) {
            $particulier =  Particular::create(['id' => Str::uuid(), 'name' => $value['name'], 'firstname' => $value['firstname'], ]);
        }

        foreach ($entreprises as $key => $value) {
            $entreprise =  Company::create(['id' => Str::uuid(), 'name' => $value['name'], 'firstname' => $value['firstname'], 'socialreason' => $value['socialreason'],]);
        }


        $clients = [
            array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','BABADAHO')->where('firstname','jean')->first()->id ?? null,'username' => 'jcr95','phone' => '968574596',
                'birthdate' => '1885/11/11', 'email' => 'monnoukpo94@gmail.com','password' => Hash::make('123456789'),'status' => false,),
            array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','AVLESSI')->where('firstname','Odilon')->first()->id ?? null,'username' => 'odir95','phone' => '36857454552',
            'birthdate' => '1994/03/09','email' => 'sewanoudiara@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','SEMAKO')->where('firstname','Fidelia')->first()->id ?? null,'username' => 'fid96','phone' => '67257516451',
            // 'birthdate' => '1995/12/11','email' => 'sefi@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','MANNOU')->where('firstname','Felicien')->first()->id ?? null,'username' => 'felicr95','phone' => '99596545750',
            // 'birthdate' => '1990/12/01','email' => 'mannou@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','SIKA')->where('firstname','Cézar')->first()->id ?? null,'username' => 'sirce96','phone' => '65256557785',
            // 'birthdate' => '1975/02/15','email' => 'sicazu@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','SANGBO')->where('firstname','Alexis')->first()->id ?? null,'username' => 'alece76','phone' => '62857965175',
            // 'birthdate' => '1991/02/02','email' => 'san@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','GANBO')->where('firstname','victor')->first()->id ?? null,'username' => 'vicr55','phone' => '218555857190',
            // 'birthdate' => '2000/05/28','email' => 'gan@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','AYLA')->where('firstname','David')->first()->id ?? null,'username' => 'ayad85','phone' => '968555457120',
            // 'birthdate' => '1895/06/16','email' => 'ayea@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','ADJOVI')->where('firstname','Eric')->first()->id ?? null,'username' => 'aric229','phone' => '92124857177',
            // 'birthdate' => '1895/06/16','email' => 'adjoa@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'particulars_id' => Particular::where('name','OLOUWA')->where('firstname','Fèmi')->first()->id ?? null,'username' => 'femi81','phone' => '98855178840',
            // 'birthdate' => '1895/06/16','email' => 'fafoua@gmail.com','password' => Hash::make('123456789'),'status' => false),
        ];

        $clientcompany = [
            array('id' => Str::uuid(), 'companies_id' => Company::where('name','AHISSOU')->where('firstname','Xavier')->first()->id ?? null,'username' => 'vcr95','phone' => '96858627452',
                'birthdate' => '1885/11/11', 'email' => 'nabilkpossa51@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','ADEOSSI')->where('firstname','Pacôme')->first()->id ?? null,'username' => 'xwr95','phone' => '366924857452',
            // 'birthdate' => '1994/03/09','email' => 'ossi@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','ADECHOLA')->where('firstname','Ayemi')->first()->id ?? null,'username' => 'nhd96','phone' => '6725752140451',
            // 'birthdate' => '1995/12/11','email' => 'nabilkpossa51@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','BOCCOSSA')->where('firstname','Merveille')->first()->id ?? null,'username' => 'sslr95','phone' => '99557021450',
            // 'birthdate' => '1990/12/01','email' => 'boco@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','HOUSSOU')->where('firstname','Gabriella')->first()->id ?? null,'username' => 'fgrce96','phone' => '665503257785',
            // 'birthdate' => '1975/02/15','email' => 'hou@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','AMATE')->where('firstname','Calos')->first()->id ?? null,'username' => 'kloe76','phone' => '600122857175',
            // 'birthdate' => '1991/02/02','email' => 'mani@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','NOUKPO')->where('firstname','Ines')->first()->id ?? null,'username' => 'mopr55','phone' => '218552057190',
            // 'birthdate' => '2000/05/28','email' => 'nou@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','AZIZA')->where('firstname','Kelvin')->first()->id ?? null,'username' => 'nhad85','phone' => '968579665120',
            // 'birthdate' => '1895/06/16','email' => 'aziza@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','SAGBOHAN')->where('firstname','Eric')->first()->id ?? null,'username' => 'byc229','phone' => '94857170017',
            // 'birthdate' => '1895/06/16','email' => 'sagbo@gmail.com','password' => Hash::make('123456789'),'status' => false),
            // array('id' => Str::uuid(), 'companies_id' => Company::where('name','MINKPE')->where('firstname','Rodolph')->first()->id ?? null,'username' => 'trei81','phone' => '988551700128',
            // 'birthdate' => '1895/06/16','email' => 'minua@gmail.com','password' => Hash::make('123456789'),'status' => false),
        ];


        foreach ($clients as $key => $value) {
            $client =  Customer::create(['id' => Str::uuid(), 'particulars_id' => $value['particulars_id'], 'username' => $value['username'],
            'phone' => $value['phone'], 'email' => $value['email'], 'birthdate' => $value['birthdate'],'email' => $value['email'],'password' => $value['password'], 'status' => $value['status'],  ]);
        }
        foreach ($clientcompany as $key => $valu) {
            $cost =  Customer::create(['id' => Str::uuid(), 'companies_id' => $valu['companies_id'], 'username' => $valu['username'],
            'phone' => $valu['phone'], 'email' => $valu['email'], 'birthdate' => $valu['birthdate'],'email' => $valu['email'],'password' => $valu['password'], 'status' => $valu['status'],  ]);
        }
    }
}
