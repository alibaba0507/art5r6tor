<?php
// This refers to the previous code block.
//require "safeCrypto.php"; 

$textToEncrypt = "My super secret information. <br> date:".date("h-i-s, j-m-y, it is w Day")." <br> rnd:".md5(uniqid(mt_rand(), false));
$encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
$secretHash = "25c6c7ff35b9979b151f2136cd13b0ff";

function encrypt($plaintext, $password) {
    $method ="AES-256-CBC";
    $key = hash('sha256', $password, true);
    //$key = hash('sha1', $password, true);
    $iv = openssl_random_pseudo_bytes(16);
    //$iv = openssl_random_pseudo_bytes(8);
    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);
    //$hash = hash_hmac('sha1', $ciphertext . $iv, $key, true);

    return base64_encode($iv . $hash . $ciphertext);
}

function decrypt($ivHashCiphertext, $password) {
    $ivHashCiphertext = base64_decode($ivHashCiphertext);
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    //$iv = substr($ivHashCiphertext, 0, 8);
    $hash = substr($ivHashCiphertext, 16, 32);
    //$hash = substr($ivHashCiphertext, 8, 16);
    $ciphertext = substr($ivHashCiphertext, 48);
    //$ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);
    //$key = hash('sha1', $password, true);
    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
   // if (!hash_equals(hash_hmac('sha2', $ciphertext . $iv, $key, true), $hash)) return null;
    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}

$encrypted_string= encrypt($textToEncrypt,$secretHash);//openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);
$decrypted_string= decrypt($encrypted_string,$secretHash);//openssl_decrypt($encrypted_string,"AES-128-ECB",$password);
//$token = base64_encode($encrypted_string);
var_dump($encrypted_string);
echo "<br>";
//var_dump(base64_decode($token));
echo "<br>";
var_dump($decrypted_string);

?>