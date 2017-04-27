<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css" rel="stylesheet" integrity="sha384-awusxf8AUojygHf2+joICySzB780jVvQaVCAt1clU3QsyAitLGul28Qxb2r1e5g+" crossorigin="anonymous">
    <title>Live Demo of Google Maps Geocoding Example with PHP</title>
    <style type="text/css">
        .boxy {
            padding: 1rem;
        }
        body {
            padding-top: 10%;
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
                    <div class="input-group input-group-lg">
                        <input class="form-control" type="text" name="address" placeholder="Enter any address" />
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </span>
                    </div>
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
            <div class="col-md-8 col-md-offset-2">
                <dl class="dl-horizontal">
                    <dt>Address</dt>
                    <dd><?=$formattedAddress?><dd>
                    <dt>Latitude</dt>
                    <dd><?=$latitude?><dd>
                    <dt>Longitude</dt>
                    <dd><?=$longitude?><dd>
                </dl>
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
