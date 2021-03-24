<?php

$latitudedb=19.2346;
$longitudedb=72.9725;
$latitude = 19.2287;
$longitude = 72.9703;

function distance(
    $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
  {
    // convert from degrees to radians
    var_dump($latitudeFrom);
    var_dump($longitudeFrom);
    var_dump($latitudeTo);
    var_dump($longitudeTo);
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);
    echo "to degree:";
    var_dump($latFrom);
    var_dump($lonFrom);
    var_dump($latTo);
    var_dump($lonTo);
    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;
    echo "after sub:";
    var_dump($latFrom);
    var_dump($lonFrom);
    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      echo "a:";
                    var_dump($angle);
    return $angle * $earthRadius;
  }
  
  
  
$distance1 = distance($latitudedb, $longitudedb, $latitude, $longitude);
$distance2 = distance(19.2346, 72.9725, 19.2287, 72.9703);
echo ("(incorrect)$distance1:  (correct)$distance2");


?>