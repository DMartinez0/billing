<?php
namespace App\System\Helpers;


class Encrypt {
   // Llaves   
   public function __construct(){
      
   }
   // private static $secretKey = '68110e88fc45224e6591ff19dbcfbb71';  // md5 $secretIv
   private static $secretIv = '68110e88fc45224e6591ff19dbcfbb71'; // md5 myemail
   // Encryption 
   private static $encryptMethod = "AES-256-CBC"; 



   public static function encrypt($data,$secretKey) {
      $key = hash('sha256', $secretKey);
      $iv = substr(hash('sha256', self::$secretIv), 0, 16);
      $result = openssl_encrypt($data, self::$encryptMethod, $key, 0, $iv);
      return $result= base64_encode($result);
   }
   

   public static function decrypt($data,$secretKey) {
      $key = hash('sha256', $secretKey);
      $iv = substr(hash('sha256', self::$secretIv), 0, 16);
      $result = openssl_decrypt(base64_decode($data), self::$encryptMethod, $key, 0, $iv);
      return $result;
   }
}