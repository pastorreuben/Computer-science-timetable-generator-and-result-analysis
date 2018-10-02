<?php
// this file validates user input
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
}

?>