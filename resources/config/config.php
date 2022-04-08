<?php

    date_default_timezone_set("Europe/Berlin");

 	$host_name = 'db5000145899.hosting-data.io';
    $database = 'dbs141179';
    $user_name = 'dbu107962';
    $password = 'hierstandmaleingeheimespasswort';

    $database = new mysqli($host_name, $user_name, $password, $database);
?>