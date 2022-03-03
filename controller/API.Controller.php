<?php



//class API{

     function APIconnection()
     {
        // set API Endpoint, access key, required parameters
        $endpoint = 'convert';
        $access_key = 'fb41774d6726232ecf395024f5b10724';
        

        $from = 'SEK';
        $to = 'EUR'; //hur många svenska kr det går på en euro = 10.758298
        //$amount = 10;

        // initialize CURL:
        $ch = curl_init('http://api.exchangeratesapi.io/v1/latest?'.$endpoint.'&access_key='.$access_key.''); //'&from='.$from.'&to='.$to.'&amount='.$amount.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the JSON data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        return $conversionResult = json_decode($json, true);

        // access the conversion result
        //var_dump($conversionResult['rates']['SEK']);
        //return $conversionResult['rates']['SEK'];
    }


    function currency($price)
    {
        $arr = $_SESSION['ExchangeRate']['rates'];

        $sek = $arr['SEK'];
        $eur = 1/$sek;

        if (isset($_SESSION['currency']))
        {
            if ($_SESSION["currency"] == 'EUR')
            {
                $calc = round(($eur*$price), 1);
                return $currency = $calc."€"; 
            }
            elseif ($_SESSION["currency"] == 'SEK') {
                $currency = $price." kr";
                return $currency;
            }
        }
        else
        {
            $currency = $price." kr";
            return $currency;
        }
        

        

        //$sek = $arrAPI['rates']['SEK']; //Sparar dagens värdet för SEK = 10.754652
        //$usd = $arrAPI['rates']['USD']; //Sparar dagens värdet för USD = 1.112472
        //$czk = $arrAPI['rates']['CZK']; //Sparar dagens värdet för CZK = 25.560698
        //var_dump($arrAPI); //rates = 168 st

        //return $usd*$price;

    }

    //echo currency(100); //100 kr
    
    
//}




function SendCheckoutMail($email, $message){
    $subject = "test";
    $html_brand = "http://localhost:5000/Email?email=".$email."&subject=".$subject."&message=".$message;
    $ch = curl_init();
    
    $options = array(
        CURLOPT_URL            => $html_brand,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POST           => 1,
        CURLOPT_ENCODING       => "",
        CURLOPT_AUTOREFERER    => true,
        CURLOPT_CONNECTTIMEOUT => 120,
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_MAXREDIRS      => 10,
    );
    curl_setopt_array( $ch, $options );
    $response = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ( $httpCode != 200 ){
        echo "Return code is {$httpCode} \n"
            .curl_error($ch);
    } else {
    }
    curl_close($ch);
}
?>

