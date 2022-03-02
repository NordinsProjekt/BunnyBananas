<?php

function SendCheckoutMail($email, $message){
    
    $subject = 'test'; 

    //echo var_dump(http_build_query($data)) . "<br>";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:5000/Email?email=".$email."&subject=".$subject."&message=".$message);
    curl_setopt($ch, CURLOPT_POST, 1); //SET POST
    //curl_setopt ($ch, CURLOPT_POSTFIELDS,  http_build_query($data)); //$data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Vi förväntar oss ett svar?

    $response = curl_exec($ch);

    if (!$response) {
        die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
    }
    curl_close($ch);
}
?>