<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;

trait RequestInputValidator
{
    /**
     * Validate Phone Number
     * @param $phoneCode
     * @param $rawPhoneNumber
     * @return string
     */
    private function filterPhoneNumber($phoneCode, $rawPhoneNumber):string
    {
        $valid = ltrim($rawPhoneNumber, '0');
        return $phoneCode.$valid; //concantenate
    }


}
