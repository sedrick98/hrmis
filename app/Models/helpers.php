<?php
use Hashids\Hashids;
/**
 * Global helpers file with misc functions.
 */
    if(! function_exists('hashId')) {
        function hashId($id) {
            $hashids = new Hashids('', 10);
            return $hashids->encode($id);
        }
    }