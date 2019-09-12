<?php
    require "lib/nusoap.php";
    
    $client = new nusoap_client("http://localhost/WebService/service.php?wsdl");
    
    $result = $client->call(
        "ReceiveResponse",
        array(
            "MOId"                  => 1,
            "Telco"                 => "viettel",
            "ServiceNum"            => "8100",
            "Phone"                 => "841694375407",
            "Syntax"                => "XXX",
            "EncryptedMessage"      => "Hahaha",
            "Signature"             => "Lalala"
        )
    );
    
    // die($result);
    // $result = json_decode($result);
    echo (log($result));
