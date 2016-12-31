<?php
namespace vendor\wp_infinite\Service;

final class ConcatService
{
    /**
     * @param $keyword
     * @return string
     * aaa => %aaa%, aaa% = aaa%
     */
    public static function CropPercentIfNotExist($keyword)
    {
        if (substr($keyword, 0, 1) != '%' and substr($keyword, strlen($keyword)-1, 1) != "%")
            return "%{$keyword}%";
        return $keyword;
    }
}
