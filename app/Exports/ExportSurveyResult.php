<?php

namespace App\Exports;

use App\Models\Survey;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSurveyResult implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Survey::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'enqueteur',
            'age',
            'sexe',
            'location',
            'profession',
            'Online payment',
            'why_not_paid',
            'which_product',
            'payment_frequency',
            'payment_obstacles',
            'payment_method',
            'choose_product_by_home_delivery',
            'use_delivery_service',
            'delivery_cost_influence_shop',
            'free_delivery_all_product',
            'improve_free_delivery',
            'online_payment_advantage',
            'online_payment_defi',
            'yes_online_payment_if_resolve',
            'which_improvment_fonctionality',
            'phone',
            'Date enregistrement',
            // Ajoutez les noms des colonnes de votre table ici
        ];
    }
}
