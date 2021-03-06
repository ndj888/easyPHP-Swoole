<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/4/1
 * Time: 下午2:52
 */

namespace Core\Component\Spl;


class SplString
{
    private $rawString;
    function __construct($rawString = null)
    {
        $this->rawString = $rawString;
    }
    function setString($string){
        $this->rawString = (String)$string;
    }
    function split($length = 1){
        return str_split($this->rawString,$length);
    }

    function encodingConvert($desEncoding,$detectList = array(
        'UTF-8',
        'ASCII',
        'GBK',
        'GB2312',
        'LATIN1',
        'BIG5',
        "UCS-2"
    )){
        $fileType = mb_detect_encoding ( $this->rawString,$detectList);
        if ($fileType != $desEncoding) {
            return mb_convert_encoding ( $this->rawString, $desEncoding , $fileType );
        }else{
            return $this->rawString;
        }
    }

    function toUtf8(){
        return $this->encodingConvert("UTF-8");
    }

    function toUnicode(){
        $raw = $this->encodingConvert("UCS-2");
        $len  = strlen($raw);
        $str  = '';
        for ($i = 0; $i < $len - 1; $i = $i + 2){
            $c  = $raw[$i];
            $c2 = $raw[$i + 1];
            if (ord($c) > 0){   //两个字节的文字
                $str .= '\u'.base_convert(ord($c), 10, 16).str_pad(base_convert(ord($c2), 10, 16), 2, 0, STR_PAD_LEFT);
            } else {
                $str .= '\u'.str_pad(base_convert(ord($c2), 10, 16), 4, 0, STR_PAD_LEFT);
            }
        }
        return strtoupper($str);//转换为大写
    }

    function explode($separator){
        return explode($separator,$this->rawString);
    }
    function subString($start,$length){
        return substr($this->rawString,$start,$length);
    }
    function compare($str,$ignoreCase = 0){
        if($ignoreCase){
            return strcasecmp($str,$this->rawString);
        }else{
            return strcmp($str,$this->rawString);
        }
    }

    function lTrim($charList = null){
        return ltrim($this->rawString,$charList);
    }
    function rTrim($charList = null){
        return rtrim($this->rawString,$charList);
    }
    function trim($charList = null){
        return trim($this->rawString,$charList);
    }

    function pad($length,$padString = null,$pad_type = STR_PAD_RIGHT ){
        return str_pad($this->rawString,$length,$padString,$pad_type);
    }
    function repeat($times){
        return str_repeat($this->rawString,$times);
    }

    function length(){
        return strlen($this->rawString);
    }

    function toUpper(){
        return strtoupper($this->rawString);
    }
    function toLower(){
        return strtolower($this->rawString);
    }
    function __toString()
    {
        // TODO: Implement __toString() method.
        return (String)$this->rawString;
    }

}