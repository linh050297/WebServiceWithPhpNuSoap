<?php
    require_once('lib/nusoap.php'); 
    require "functions.php";
    
    $server = new nusoap_server();
    $server->configureWSDL("Partner", "urn:Partner");
    
    $server->register(
        "ReceiveResponse",
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
    
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : "";
    $server->service($HTTP_RAW_POST_DATA);
    
?>