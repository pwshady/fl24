<?php

namespace fl;

class Registry

{

    use traits\TSingleton;



    private static string $url = '';
    private static string $land = '';
    protected static string $language = '';


    //Url
    public static function setUrl($url): int
    {
        self::$url = $url;
        return 1;
    }

    public static function getUrl(): string
    {
        return self::$url;
    }

    //Land
    public static function setLand($land):int
    {
        self::$land = $land;
        return 1;
    }

    public static function getLand():string
    {
        return self::$land;
    }

    //Lang
    public static function setLanguage($language):int
    {
        self::$language = $language;
        return 1;
    }

    public static function getLanguage():string
    {
        return self::$language;
    }

}
