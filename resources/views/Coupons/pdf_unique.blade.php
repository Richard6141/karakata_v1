<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body style="font-size: 11px;">
    <table style="border: 3px solid #8EC741; width:400px; height:200px; border-radius:10px; margin-bottom: 10px; margin-right: auto; margin-left: auto;">
        <tr>
            <div>
                <div style="float: left; width: 150px; height: 50px;"><img style="width: 100%; height:100%" src="https://web.topfood.bj/images/LogotTF.png" alt="Logo"></div>
                <div style="float: right; height: 30px; width: 30%; border-radius: 0 10px 0 20px; background-color: #F4681E; text-align: center; color: #fff; font-weight: bold; font-size:18px">{{ $coupon->price }} FCFA</div>
            </div>
        </tr>
        <tr>
            <div style="width: 100%; border: 1px solid #8EC741; background-color: #8EC741; margin-top:50px; text-align: center; font-weight: bold;">TICKET</div>
        </tr>
        <table style="display: flex;">
            <table style="width: 50%; float: left">
                <table style="width: 100%">
                    <tr>
                        <td>Nom:</td>s
                        @if ($customer->particulars_id != null && $customer->companies_id == null)
                        <td style="border-bottom:1px dotted #f00;">{{$client->name}} {{$client->firstname}}</td>
                        @endif
                        @if($customer->particulars_id == null && $customer->companies_id != null)
                        <td style="border-bottom:1px dotted #f00; width: 80%">{{$client->socialreason}}</td>
                        @endif
                    </tr>
                </table>
                <table style="width: 100%">
                    <tr>
                        <td>Téléphone :</td>s
                        <td style="border-bottom:1px dotted #f00; width: 70%">{{$customer->phone}}</td>
                    </tr>
                </table>
                <table style="width: 100%">
                    <tr>
                        <td>Date d'émission :</td>
                        <td style="border-bottom:1px dotted #f00; width: 55%">{{$coupon->issue_date}}</td>
                    </tr>
                </table>
                <table style="width: 100%">
                    <tr>
                        <td>Date d'expiration :</td>
                        <td style="border-bottom:1px dotted #f00; width: 54%">{{$coupon->expiry_date}}</td>
                    </tr>
                </table>
                <table style="width: 100%">
                    <tr>
                        <td style="position: relative; top:19px">Code coupon :</td>
                        <td style="border-bottom:1px dotted #f00; width: 58%">{{$coupon->coupon_unique_code}}</td>
                        </td>
                    </tr>
                </table>
            </table>
            <table style="width: 50%; float: right">
                <table style="width: 100%">
                    <tr>
                        <td>Date d'utilisation :</td>s
                        <td style="border-bottom:1px dotted #f00; width: 50%"></td>
                    </tr>
                </table>
                <table style="width: 100%">
                    <tr>
                        <td>Appréciations :</td>
                    </tr>
                    <tr>
                        <td><input style="position: relative; top:9px" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Pas satisfait </label><br>
                        </td>
                        <td><input style="position: relative; top:9px" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Satisfait </label><br>
                        </td>
                    </tr>
                    <tr>
                        <td><input style="position: relative; top:9px" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Peu satisfait </label><br>
                        </td>

                        <td><input style="position: relative; top:9px" type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                            <label for="vehicle1"> Très satisfait </label><br>
                        </td>
                    </tr>
                </table>
            </table>

        </table>
    </table>
</body>

</html>

<style>
    @page {
        margin: 15px auto;
    }
</style>