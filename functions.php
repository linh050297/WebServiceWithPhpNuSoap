<?php
    /**
     * response message
     * @param int $MOId
     * @param string $Telco
     * @param string $ServiceNum
     * @param string $Phone
     * @param string $Syntax
     * @param string $EncryptedMessage
     * @param string $Signature
     * @return string
     */
    function ReceiveResponse($MOId, $Telco, $ServiceNum, $Phone, $Syntax, $EncryptedMessage, $Signature)
    {
        if($MOId <= 0 || empty($Telco) || empty($ServiceNum) || empty($Phone) || empty($Syntax) || empty($EncryptedMessage) || empty($Signature))
        {
            // check param input empty reuturn text
            return "01|Param Invalid";
        }
        else
        {   
            $privateKey = 5706938339623435876548;
            //decode EncryptedMessage
            $MessageRequest = base64_decode($EncryptedMessage);
            //gerenate MySignature
            $MySignature = base64_encode(sha1($MOId . $ServiceNum . $Phone . strtolower($MessageRequest) . $privateKey, true));
            //compare MySignature vs Signature
            if($MySignature != $Signature){
                return "01|Singnature is wrong";
            }else{
                return "00|.$MessageRequest.";
            };
        }
    }