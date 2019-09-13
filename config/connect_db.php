<?php 

//connect DB and savedata message
$con = mysqli_connect("localhost", "root","mysql", "detailmessage" );
if(!$con){
    echo 'Connection Error: '. mysqli_connect_error();
}

?>