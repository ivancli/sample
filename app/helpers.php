<?php

if (!function_exists('message_bag')) {
    function message_bag($message)
    {
        return new \Illuminate\Support\MessageBag([$message]);
    }
}

if (!function_exists('customLog')) {
    function customLog(Illuminate\Http\Request $request = null, $context = null)
    {
        $logger = new \App\Services\Helpers\CustomLogger(\App::environment());

        if (func_num_args() == 0) {
            return $logger;
        }

        return $logger->buildMessage($request, $context);

    }
}

if (!function_exists('pkcs5_pad')) {
    function pkcs5_pad($text, $blocksize)
    {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
}

if (!function_exists('aes_128_encrypt')) {
    function aes_128_encrypt($input, $key)
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($input, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        $data = base64_encode($iv . $hmac . $ciphertext_raw);

        return $data;
    }
}


if (!function_exists('aes_128_decrypt')) {
    function aes_128_decrypt($sStr, $sKey)
    {
        $c = base64_decode($sStr);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $sKey, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $sKey, $as_binary = true);
        if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
        {
            return $original_plaintext;
        }
    }

}