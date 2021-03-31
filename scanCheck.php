<?php

    //getting db connection
    require_once 'connect.php';

    $sessionId = $_POST['SessionID'];
    $qrcode = $_POST['qrcode'];
    $qrdate = $_POST['qrdate'];
    $timestamp = $_POST['timestamp'];
    $departId = $_POST['DepartQID'];
    $status = strtolower($_POST['status']);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $subjectId = $_POST['SubjectQID'];

    //an array to display response
    $output = array();

    $stmt = $connection->prepare("SELECT * FROM qrcode WHERE SessionID = ?");
    $stmt->bind_param("s", $sessionId);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        //save the database values to these variables
        $stmt->bind_result($sessionIddb, $qrcodedb, $qrdatedb, $timestampdb, $departQIDdb, $statusdb, $latitudedb, $longitudedb, $subjectQIDdb);
        $stmt->fetch();

        if($status == "active"){
            if(!strcmp($sessionId, $sessionIddb) && !strcmp($qrcode, $qrcodedb) && !strcmp($departId, $departQIDdb) && !strcmp($subjectId, $subjectQIDdb)){

                // find the distance
                function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
                {
                    echo "para check:";
                    $latitudeTo= (float)$latitudeTo;
                    $longitudeTo=(float)$longitudeTo;
                    var_dump($latitudeFrom);
                    var_dump($longitudeFrom);
                    var_dump($latitudeTo);
                    var_dump($longitudeTo);
                   
                    // convert from degrees to radians
                    
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
                    return $angle * $earthRadius; //(result in meters)
                }     
                
                

                // function distance($lat1, $lon1, $lat2, $lon2) { 
                //     echo "para check:  ".$lat1 ;
                //     $lat2=(float)$lat2;
                //      $lon2 = (float)$lon2;
                //     var_dump($lat1);
                //     var_dump($lon1);
                //     var_dump($lat2);
                //     var_dump($lon2);
                //     $pi80 = M_PI / 180; 
                //     $lat1 *= $pi80; 
                //     $lon1 *= $pi80; 
                //     $lat2 *= $pi80; 
                //     $lon2 *= $pi80; 
                //     echo "to degree:";
                //     var_dump($lat1);
                //     var_dump($lon1);
                //     var_dump($lat2);
                //     var_dump($lon2);
                //     $r = 6372.797; // mean radius of Earth in km 
                //     $dlat = $lat2 - $lat1; 
                //     $dlon = $lon2 - $lon1; 
                //     echo "after sub:";
                //     var_dump($dlat);
                //     var_dump($dlon);
                //     $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
                //     $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
                //     echo " a and c and k";
                //     var_dump($a);
                //     var_dump($c);
                //     $km = $r * $c; 
                //     //echo ' '.$km; 
                //     var_dump($km);
                //     return $km; 
                //     }
                $distance1 = distance($latitudedb, $longitudedb, $latitude, $longitude);
                $distance2 = distance(19.2346, 72.9725, 19.2287, 72.9703);
                // var_dump($longitudedb);
               
                echo ("(incorrect)$distance1:  (correct)$distance2");

                #$output['isSuccess'] = 1;
                #$output['distance1'] = $distance1;
                #$output['distance2'] = $distance2;
            }
            else{
                $output['message'] = "Invalid QR Code!";
            }    
        }
        else{
            $output['isSuccess'] = 0;
            $output['message'] = "The QR Code has expired!";
        }        
    }
    else{
        $output['isSuccess'] = 0;
        $output['message'] = "The sessionId does not exist!";
    }

    echo json_encode($output);
?>


