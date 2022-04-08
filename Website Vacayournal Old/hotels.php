<?php
include("session.php");

$response = Unirest\Request::get("https://apidojo-kayak-v1.p.rapidapi.com/hotels/create-session?airportcode=HAN&rooms=1&citycode=42700&checkin=2018-12-20&checkout=2018-12-24&adults=1",
    array(
        "X-RapidAPI-Host" => "apidojo-kayak-v1.p.rapidapi.com",
        "X-RapidAPI-Key" => "b1e2c7d83emsh51a4a618efd7018p1fe53ejsnb2e0621c3af8"
    )
);

print_r($response);


?>