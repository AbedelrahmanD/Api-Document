<?php

include_once __DIR__ . "./../autoload_register.php";

class Utils {



    public static function api($apiFile, $data = [],$debug=false) {

        if (!isset($data["action"])) {
            $data["action"] = "select";
        }

        $url = Config::$baseUrl . "Api/$apiFile.php";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);
        if($debug){
            var_dump($url);
            echo "<br>";
            var_dump($result);
        }
      
        if (curl_errno($ch)) {
            echo curl_error($ch);
        }


        return json_decode($result, true);
    }

}
