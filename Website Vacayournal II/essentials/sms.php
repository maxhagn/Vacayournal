<?php

function sendSms( $number, $message ) {
    $data = array("from" => "Vacayournal", "text" => "${message}", "to" => "${number}", "api_key" => "021eda20", "api_secret" => "Tz2iQkYZwS5Ge2Ge");
    $data_string = json_encode($data);

    $ch = curl_init('https://rest.nexmo.com/sms/json');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );

    $result = curl_exec($ch);
}
