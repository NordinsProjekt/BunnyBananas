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

    try{
        $subject = 'test'; 

        //echo var_dump(http_build_query($data)) . "<br>";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:5000/Email?email=".$email."subject=".$subject."message=".$message);
        curl_setopt($ch, CURLOPT_POST, 1); //SET POST
        //curl_setopt ($ch, CURLOPT_POSTFIELDS,  http_build_query($data)); //$data
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Vi förväntar oss ett svar?

        $response = curl_exec($ch);

        if (!$response) {
            //die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);

    } catch (\Throwable $e) {
        //fuckit! Om apit inte är igång eller något annat går fel så gör vi ingenting
        die();
    }


}
?>

