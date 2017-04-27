<?php

$config = json_decode(file_get_contents('.config.json'));

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

function distance($origin, $destination)
{
    $origin = urlencode($origin);
    $destination = urlencode($destination);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destination}&key={$config['api-key']}";
    $data = json_decode(file_get_contents($url), true);
    if ($data['status'] == 'OK') {
        $originAddress = $data['origin_addresses'][0];
        $destinationAddress = $data['destination_addresses'][0];
        $distance = $data['rows'][0]['elements'][0]['distance']['text'];
        if ($originAddress && $destinationAddress && $distance) {
            return [
                'origin' => $originAddress,
                'destination' => $destinationAddress,
                'distance' => $distance
            ];
        }
    }
    return false;
}
