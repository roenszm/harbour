<?php
/**
 * Created by PhpStorm.
 * User: roens
 * Time: 2018-1-15 09:58:29
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Functions
{

    public function __construct()
    {

    }

    //验证一个字符串是否是email格式，只做最低限度的验证
    public function email_validate($string)
    {
        $match = preg_match('/^([^@\s]+)@(\S+)$/', $string);
        return $match;
    }


}
