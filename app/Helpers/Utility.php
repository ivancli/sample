<?php

namespace App\Helpers;


class Utility
{
    /**
     * @param array $items
     * @return string
     */
    public static function fingerprint(array $items)
    {
        return sha1(implode('|', $items));
    }

}