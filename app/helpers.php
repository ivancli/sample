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
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
        $input = pkcs5_pad($input, $size);
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_ECB, '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return $data;
    }
}


if (!function_exists('aes_128_decrypt')) {
    function aes_128_decrypt($sStr, $sKey)
    {
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $sKey, base64_decode($sStr), MCRYPT_MODE_ECB);
        $dec_s = strlen($decrypted);
        $padding = ord($decrypted[$dec_s - 1]);
        $decrypted = substr($decrypted, 0, -$padding);
        return $decrypted;
    }

}