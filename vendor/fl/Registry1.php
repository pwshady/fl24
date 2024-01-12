<?php

namespace fl;

class Registry

{

    protected static array $settings = [
        'title' => '',
        'styles' => [
            ['label' => '', 'type' => '', 'path' => ''],
            ['label' => 'test', 'type' => '', 'path' => '']
        ],
        'header_scripts' => [
            ['label' => '', 'type' => '', 'path' => '']
        ],
        'header_strings' => [
            ['label' => '', 'string' => '']
        ],
        'footer_scripts' => [
            ['label' => '', 'type' => '', 'path' => '']
        ],
        'footer_strings_top' => [
            ['label' => '', 'string' => '']
        ],
        'footer_strings_bottom' => [
            ['label' => '', 'string' => '']
        ],
    ];


    /*
    *Key: 'name' - modul name. Required key
    *Key: 'complete' - Value 1 after code processing
    *Key: 'object' - Resulting from the creation of the modul
    */
    protected static array $modules = [];

    /*
    *Key: 'name' - widget name. Required key
    *Key: 'complete' - Value 1 after code processing
    *Key: 'code' - Html code resulting from the creation of the widget
    *Key: 'cache' - Html code caching time in seconds. Optional key
    *Key: 'view' - View selector. Optional key
    */
    protected static array $widgets = [];














    public static function setSetting($key, $value)
    {
        $method = 0;
        $pos = true;
        if (is_array($value)) {
            if (array_key_exists('method', $value)) {
                $method = $value['method'];
            }
        }
        if (is_array($value)) {
            if (array_key_exists('pos', $value)) {
                $pos = $value['pos'];
            }
        }
        switch ($method) {
            case 0:
                if (is_array($value)) {
                    self::$settings[$key][0] = $value;
                } else {
                self::$settings[$key] = $value;
                }
                break;
            case 1:
                if ($pos) {
                    array_push(self::$settings[$key], $value);
                } else {
                    array_unshift(self::$settings[$key], $value);
                }       
                break;
            case -1:
                if (is_array($value)) {
                    if (array_key_exists('label', $value)) {
                        $label = $value['label'];
                        $result = [];
                        foreach (self::$settings[$key] as $v) {
                            if (array_key_exists('label', $v)) {
                                if ($label != $v['label']) {
                                    array_push($result, $v);
                                }                               
                            } else {
                                array_push($result, $value);
                            }
                        }
                        self::$settings[$key] = $result;
                        break;
                    } 
                }
                self::$settings[$key] = null;
                break;
        }       
    }

    public static function getSetting($key)
    {
        return self::$settings[$key] ?? null;
    }

    public static function getSettings()
    {
        return self::$settings;
    }







    public static function setModul($name, $params)
    {
        $method = true;
        $pos = true;
        $result = [];
        foreach (self::$modules as $modul) {
            if ($name != $modul['name']) {
                array_push($result, $modul);
            }                               
        }
        if (array_key_exists('method', $params)) {
            $method = $params['method'];
        }
        if (array_key_exists('pos', $params)) {
            $pos = $params['pos'];
        }
        if ($method) {
            $modul = array_merge(['name' => $name, 'complete' => false, 'object' => null], $params);
            if ($pos) {
                array_push($result, $modul);
            } else {
                array_unshift($result, $modul);
            }
        }
        self::$modules = $result;
    }

    public static function getModul($name)
    {
        foreach ( self::$modules as $key => $value) {
            if ( array_key_exists('name', $value) ) {
                if ( $value['name'] == $name ) 
                {
                    return $value;
                }
            }
        }
        return null;
    }

    public static function getModules()
    {
        return self::$modules;
    }

    public static function updateModul($modul)
    {
        foreach ( self::$modules as $key => $value) {
            if ( array_key_exists('name', $value) ) {
                if ( $modul['name'] == $value['name'] ) {
                    self::$modules[$key] = $modul;
                }
            }
        }
    }

    public static function setWidget($name, $params)
    {
        $method = true;
        $pos = true;
        $result = [];
        foreach (self::$widgets as $widget) {
            if ($name != $widget['name']) {
                array_push($result, $widget);
            }                               
        }
        if (array_key_exists('method', $params)) {
            $method = $params['method'];
        }
        if (array_key_exists('pos', $params)) {
            $pos = $params['pos'];
        }
        if ($method) {
            $widget = array_merge(['name' => $name, 'complete' => false, 'code' => ''], $params);
            if ($pos) {
                array_push($result, $widget);
            } else {
                array_unshift($result, $widget);
            }
        }
        self::$widgets = $result;
    }

    public static function getWidget($name)
    {
        foreach ( self::$widgets as $key => $value) {
            if ( array_key_exists('name', $value) ) {
                if ( $value['name'] == $name ) 
                {
                    return $value;
                }
            }
        }
        return null;
    }

    public static function getWidgets()
    {
        return self::$widgets;
    }

    public static function updateWidget($widget)
    {
        foreach ( self::$widgets as $key => $value) {
            if ( array_key_exists('name', $value) ) {
                if ( $widget['name'] == $value['name'] ) {
                    self::$widgets[$key] = $widget;
                }
            }
        }
    }




    public function getPrefix()
    {
        $prefix = self::getUrl();
        //nedodelano
        if (file_exists(ROOT . '/app/landlang.json')){
            $prefix.= App::$app->getLanguage()['code'] . '/';
        }
        return $prefix;
    }

    public function getAprefix()
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . self::getPrefix();
    }

    function getLink($mode = 0)
    {
        $link = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . self::getPrefix();
        if (!empty(self::getPage())) {
            $link .= self::getPage();
        }
        if (!empty(self::getRequest())) {
            $link .= '/' . self::getRequest();
        }
        if (!empty(self::getGet())) {
            $link .= '?' . self::getGet();
        }
        if ($mode) {
            return $link;
        }
        header('Location: ' . $link);
        die;
    }

    function getPublic()
    {
        return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . self::getUrl();
    }

}