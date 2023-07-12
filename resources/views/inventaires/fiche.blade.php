<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table style=" width:100%; height:200px; border-radius:10px; margin-bottom: 10px; margin-right: auto; margin-left: auto;">
        <tr>
            <div style="float: right; width: 200px; height: 70px;"><img style="width: 100%; height:100%" src="https://web.topfood.bj/images/LogotTF.png" alt="Logo"></div>
        </tr>
        <tr>
            <div style="border: 1px solid; width: 100%; margin-top:100px; margin-bottom: 10px; text-align:center; background-color: #8EC741">FICHE D’INVENTAIRE DU ..../..../....</div>
        </tr>

        <table style="width:100%; border-collapse:collapse; margin-top:20px">
            <tr style="color:black">
                <th style="border: 1px solid; background-color: #8EC741">Produit</th>
                <th style=" border: 1px solid; background-color: #8EC741">Stock réel</th>
                <th style="border: 1px solid; background-color: #8EC741">Bon</th>
                <th style=" border: 1px solid; background-color: #8EC741">Moyen</th>
                <th style="border: 1px solid; background-color: #8EC741">Hors d'usage</th>
                <th style=" border: 1px solid; background-color: #8EC741">Expiré</th>
                <th style="border: 1px solid; background-color: #8EC741">Observations</th>
            </tr>
            <tbody>
                @foreach($produits as $produit)
                <tr>
                    <td style=" border: 1px solid; text-align: center;">{{$produit->label}}</td>
                <td style="border: 1px solid; text-align: center;"></td>
                <td style="border: 1px solid; text-align: center;"></td>
                <td style="border: 1px solid; text-align: center;"></td>
                <td style="border: 1px solid; text-align: center;"></td>
                <td style="border: 1px solid; text-align: center;"></td>
                <td style="border: 1px solid; text-align: center;"></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <table style="width: 100%;">
            <tr>
                <div style="float: right; width: 200px; height: 70px; margin-top:25px">Inventoriste :</div>
            </tr>

        </table>



    </table>
</body>

</html>