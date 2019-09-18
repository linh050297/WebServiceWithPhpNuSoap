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
    function sendMt($MOId, $Telco, $ServiceNum, $Phone, $Syntax, $EncryptedMessage, $Signature)
    {
        try {

        if($MOId <= 0 || empty($Telco) || empty($ServiceNum) || empty($Phone) || empty($Syntax) || empty($EncryptedMessage) || empty($Signature))
        {
            // check param input empty reuturn text
            return "01|Param Invalid";
        }
        else
        {   
            include('config/connect_db.php'); 

            $privateKey = "5706938339623435876548";
            //decode EncryptedMessage
            $MessageRequest = base64_decode($EncryptedMessage);

            //check serviceNumber
            $pattern = '/^\s*((PC {1,3})([a-zA-Z0-9]+ {1,3})([0-9]{8,12})\s*$)|(^\s*(PC {1,3})(VAY)\s*$)/i';

            // check EncryptedMessage after decode
            $messageResponse = "";

            if (preg_match($pattern, $MessageRequest)) {
                $messageResponse = 'PawnCredit se phan hoi den quy khach hang trong vong 24 gio. Chi tiet lien he Bo phan tu van 0888 211 822. Xin cam on!';
            } else {
                $messageResponse = 'Cu phap tin nhan khong hop le.';
            }

            //gerenate MySignature
            $MySignature = base64_encode(sha1($MOId . $ServiceNum . $Phone . strtolower($MessageRequest) . $privateKey, true));
            //compare MySignature vs Signature
            
            if($MySignature != $Signature){
                return "01|Singnature is wrong";
            }else{

                // query and save to DB
                $sql = "INSERT INTO mess_details (MOId, Telco, ServiceNum, Phone, Syntax, messageResponse) VALUES ('$MOId', '$Telco', '$ServiceNum', '$Phone', '$Syntax', '$messageResponse')";
                if(mysqli_query($con, $sql)){
                //sucess
                }else{
                echo 'Query Error: '.mysqli_error($con);
                }

                return "00|$messageResponse";
            };
        }
    } catch (Exception $e){
        echo 'Message: '.$e->getMessage();
        return "01|System error";
    }
    };

    function sentData($MOId){
        return $MOId;
    }