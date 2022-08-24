<?php

class Utils
{
    public static $basicUrl="http://localhost/github/API-Document-V2/";
    
    public static function api($apiFile, $data = [])
    {
        if (!isset($data["action"])) {
            $data["action"] = "select";
        }
     
        $url=self::$basicUrl."Api/$apiFile.php";
        $ch=  curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($ch);
        return json_decode($result,true);
    }
}
