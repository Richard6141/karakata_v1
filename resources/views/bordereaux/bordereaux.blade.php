<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="font-size: 12px;">

    <table style="border: 3px solid #8EC741; width: 80%; height:250px; margin-right:auto; margin-left:auto; ">
        <table style="display: flex;">
            <div style="float: left; width: 150px; height: 50px;"><img style="width: 100%; height:100%" src="https://web.topfood.bj/images/LogotTF.png" alt="Logo"></div>
            <div style="float: right;"><span style="font-weight: bold;">N° de bordereau :</span> <span>{{$commande->slip_number}}</span></div>
        </table>
        <table style="text-align: center; width: 100%; margin-top:60px; margin-bottom:10px">
            <div style="font-size: 16px;">BORDEREAU DE COMMANDE</div>
        </table>
        <table style="display: flex;">
            <table style="border: 1px solid #8EC741; width: 50%; float: left">
                @if ($typeOfClient == 'Particular') 
                <tr>
                    <td style="width: 30%;">Nom du client :</td>s
                    <td style="border-bottom:1px dotted #f00; width: 50%"><span>{{$client->name ?? ''}}</span> <span>{{$client->firstname ?? ''}}</span> </td>
                </tr>
                @endif
                @if ($typeOfClient == 'Company') 
                <tr>
                    <td style="width: 30%;">Nom du client :</td>s
                    <td style="border-bottom:1px dotted #f00; width: 50%"><span>{{$client->name ?? ''}}</span> <span>{{$client->firstname ?? ''}} ({{$client->socialreason}})</span> </td>
                </tr>
                @endif

                <tr>
                    <td style="width: 50%">N° de téléphone :</td>
                    <td style="border-bottom:1px dotted #f00; width: 50%">{{$customer->phone ?? ''}}</td>
                </tr>
                <tr>
                    <td style="width: 50%">Mode de paiement :</td>
                    <td style="border-bottom:1px dotted #f00; width: 50%">{{$mode_paiement->label ?? ''}}</td>
                </tr>
                <tr>
                    <td>Date :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$commande->created_at ?? ''}}</td>
                </tr>
            </table>
            <table style="border: 1px solid #8EC741; width: 50%; float: right">

                <tr>
                    <td style="width: 50%">Type de pack :</td>
                    <td style="border-bottom:1px dotted #f00; width: 50%">{{$pack->label ?? ''}}</td>
                </tr>
                <tr>
                    <td>Prix du pack :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$pack->price}} FCFA</td>
                </tr>
                <tr>
                    <td>Quantité :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$commande->number}}</td>
                </tr>
                <tr>
                    <td>Prix total :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$price}} FCFA</td>
                </tr>
            </table>
        </table>
        <table style="width: 100%;height: 15%;">
            <div style="text-align: center; background-color: #8EC741; height: 25px; margin-top:85px; font-weight: bold; font-size: 16px;">Adresse de livraion</div>
            <div style="border: 1px solid; height:60px; margin-top: 5px; padding:5px">{{$district->label ?? ''}} <br>
                <span>Informations supplémentaires</span>
            </div>
        </table>
        <table style="width: 100%;">
            <div style="font-size: 9px; text-align: center; border: 1px solid; background-color: #F4681E; height: 25px; color: #FFFFFF; font-weight: bold; padding-top:8px">Ce bordereau TOP FOOD sert, aussi de reçu de paiement. Tél ou whatsapp:(+229) 65 55 55 55 / (+229) 69 12 12 12 Mobile Money (+229) 69 68 02 84</div>
        </table>
    </table>

    <table style="border: 3px solid #8EC741; width: 80%; height:250px; margin-right:auto; margin-left:auto; margin-top:50px ">
        <table style="display: flex;">
            <div style="float: left; width: 150px; height: 50px;"><img style="width: 100%; height:100%" src="https://web.topfood.bj/images/LogotTF.png" alt="Logo"></div>
            <div style="float: right;"><span style="font-weight: bold;">N° de bordereau :</span> <span>{{$commande->slip_number}}</span></div>
        </table>
        <table style="text-align: center; width: 100%; margin-top:60px; margin-bottom:10px">
            <div style="font-size: 16px;">BORDEREAU DE COMMANDE</div>
        </table>
        <table style="display: flex;">
            <table style="border: 1px solid #8EC741; width: 50%; float: left">
                @if ($typeOfClient == 'Particular') 
                <tr>
                    <td style="width: 30%;">Nom du client :</td>s
                    <td style="border-bottom:1px dotted #f00; width: 50%"><span>{{$client->name ?? ''}}</span> <span>{{$client->firstname ?? ''}}</span> </td>
                </tr>
                @endif
                @if ($typeOfClient == 'Company') 
                <tr>
                    <td style="width: 30%;">Nom du client :</td>s
                    <td style="border-bottom:1px dotted #f00; width: 50%"><span>{{$client->name ?? ''}}</span> <span>{{$client->firstname ?? ''}} ({{$client->socialreason}})</span> </td>
                </tr>
                @endif

                <tr>
                    <td style="width: 50%">N° de téléphone :</td>
                    <td style="border-bottom:1px dotted #f00; width: 50%">{{$customer->phone ?? ''}}</td>
                </tr>
                <tr>
                    <td style="width: 50%">Mode de paiement :</td>
                    <td style="border-bottom:1px dotted #f00; width: 50%">{{$mode_paiement->label ?? ''}}</td>
                </tr>
                <tr>
                    <td>Date :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$commande->created_at ?? ''}}</td>
                </tr>
            </table>
            <table style="border: 1px solid #8EC741; width: 50%; float: right">

                <tr>
                    <td style="width: 50%">Type de pack :</td>
                    <td style="border-bottom:1px dotted #f00; width: 50%">{{$pack->label ?? ''}}</td>
                </tr>
                <tr>
                    <td>Prix du pack :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$pack->price}} FCFA</td>
                </tr>
                <tr>
                    <td>Quantité :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$commande->number}}</td>
                </tr>
                <tr>
                    <td>Prix total :</td>
                    <td style="border-bottom:1px dotted #f00; width: 80%">{{$price}} FCFA</td>
                </tr>
            </table>
        </table>
        <table style="width: 100%;height: 15%;">
            <div style="text-align: center; background-color: #8EC741; height: 25px; margin-top:85px; font-weight: bold; font-size: 16px;">Adresse de livraion</div>
            <div style="border: 1px solid; height:60px; margin-top: 5px; padding:5px">{{$district->label ?? ''}} <br>
                <span>Informations supplémentaires</span>
            </div>
        </table>
        <table style="width: 100%;">
            <div style="font-size: 9px; text-align: center; border: 1px solid; background-color: #F4681E; height: 25px; color: #FFFFFF; font-weight: bold; padding-top:8px">Ce bordereau TOP FOOD sert, aussi de reçu de paiement. Tél ou whatsapp:(+229) 65 55 55 55 / (+229) 69 12 12 12 Mobile Money (+229) 69 68 02 84</div>
        </table>
    </table>
</body </html>


<style>
    @page {
        margin: 10px;
    }

    /* .card-content {
        width: 700px;
        height: 370px;
        border: 7px solid #8EC741;
        padding: 10px;
        margin: auto;
        margin-bottom: 20px;
    }

    .logo {
        float: left;
        width: 30%;
        height: 60px;
    }

    .logo>img {
        width: 100%;
        height: 100%;
    }


    .horizontal_part_1 {
        width: 100%;
        height: 10%;
    }

    .horizontal_part_2 {
        width: 100%;

        height: 85%;
        display: flex;
    }

    .horizontal_part_3 {

        text-align: center;

    }


    .horizontal_part_3 {
        width: 100%;

        display: flex;
        height: 5%;
        margin: auto;
    }

    .horizontal_part_3>p {
        margin: auto;
        text-align: center;
        font-size: 14px;
    }

    .vertical_part_1 {
        height: 100%;
        padding-right: 5px;
        width: 70%;
    }

    .vertical_part_2 {
        height: 100%;
        width: 30%;
        border-left: 6px solid #8EC741;
        padding-left: 5px;
    }

    span {
        color: black;
        font-weight: bold;
    }

    .bordereau_id {
        width: 30%;
        float: right;
    }

    .first_component {
        height: 35px;
        background-color: #8EC741;
    }

    .middle_component {
        height: 30px;
        background-color: #8EC741;
        display: flex;
        margin: 10px auto;
    }

    .separator {
        background-color: #8EC741;
        height: 2px;
        margin: 5px 0;
    }

    .middle_component_1 {
        width: 60%;
    }

    .middle_component_2 {
        width: 40%;
        text-align: center;
    }

    .end_component {
        height: 100px;
        display: flex;
        margin: 10px auto;

    }

    .end_component_1 {
        width: 60%;
        height: 100%;
        border: 2px solid;

    }

    .end_component_2 {
        width: 40%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .num {
        width: 70%;
        height: 40px;
        margin: auto;
        border: 2px solid;
    } */
</style>