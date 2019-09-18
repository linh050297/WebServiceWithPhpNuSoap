<?php
    require_once('lib/nusoap.php'); 
    require "functions.php";
    
    $server = new nusoap_server();
    $server->configureWSDL("SenBacWS", "urn:SenBacWS");
    // php version > 7
    if(!isset($HTTP_RAW_POST_DATA)){
        $HTTP_RAW_POST_DATA = file_get_contents("php://input");
    }

    

    $server->register(
        "sendMt",
        array(
            "MOId"          => "xsd:int",
            "Telco"         => "xsd:string",
            "ServiceNum"    => "xsd:string",
            "Phone"         => "xsd:string",
            "Syntax"        => "xsd:string",
            "EncryptedMessage" => "xsd:string",
            "Signature"     => "xsd:string"
        ),
        array("return" => "xsd:string")
    );
    $server->register(
        "sentData",
        array(
            "MOId"          => "xsd:int"
        ),
        array("return" => "xsd:string")
    );
    
    // Use the request to invoke the service
    //for php version < 7
// $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);  //php version < 7 or >7
    
?>