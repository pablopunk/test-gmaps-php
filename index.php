<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" />
    <title>Live Demo of Google Maps Geocoding Example with PHP</title>
    <style type="text/css">
        .boxy {
            padding: 1rem;
        }
        body {
            padding-top: 20vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row boxy">
            <div class="col-md-6 col-md-offset-3">
                <h3>Address Finder</h3>
            </div>
        </div>
        <div class="row boxy">
            <div class="col-md-6 col-md-offset-3">
                <form action="" method="post">
                    <input type="text" name="address" placeholder="Enter any address" />
                    <button type="submit" class="btn-primary">Geocode</button>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
if ($_POST && array_key_exists('address', $_POST)) {
    $data = geocode($_POST['address']);
    $latitude = $data[0];
    $longitude = $data[1];
    $formattedAddress = $data[2];
    ?>
    <div class="container">
        <div class="row boxy">
            <div class="col-md-6 col-md-offset-3">
                <div class="row">
                    <div class="col-md-2">Address:</div>
                    <div class="col-md-10"><?=$formattedAddress?></div>
                </div>
                <div class="row">
                    <div class="col-md-2">Latitude:</div>
                    <div class="col-md-10"><?=$latitude?></div>
                </div>
                <div class="row">
                    <div class="col-md-2">Longitude:</div>
                    <div class="col-md-10"><?=$longitude?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

</html>

<?php

function geocode($address)
{
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
    $data = json_decode(file_get_contents($url), true);
    if ($data['status'] == 'OK') {
        $lat = $data['results'][0]['geometry']['location']['lat'];
        $lgn = $data['results'][0]['geometry']['location']['lng'];
        $formattedAddress = $data['results'][0]['formatted_address'];
        if ($lat && $lgn && $formattedAddress) {
            return [$lat, $lgn, $formattedAddress];
        }
    }
    return false;
}

?>
