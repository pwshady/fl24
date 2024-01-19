<?php

namespace fl;

class Registry

{

    use traits\TSingleton;

    private static string $url = '';
    private static string $land = '';
    private static string $language = '';
    private static string $page = '';
    private static bool $single = false;
    private static string $request = '';
    private static string $get = '';

    private static array $userRoles = [];

    private static array $labels = [
        'p__' => 'label'
    ];

    private static array $errors = [
        '404' => '',
        '500' => '',
    ];

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
    *Key: 'object' - Resulting from the creation of the modul
    *Key: 'code' - Html code resulting from the creation of the widget
    *Key: 'view' - View selector. Optional key
    */
    protected static array $widgets = [];


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

    //Page
    public static function setPage($page):int
    {
        self::$page = $page;
        return 1;
    }

    public static function getPage(): string
    {
        return self::$page;
    }

    //Single
    public static function setSingle():int
    {
        self::$single = true;
        return 1;
    }
    public static function getSingle():bool
    {
        return self::$single;
    }

    //Request
    public static function setRequest($request):int
    {
        self::$request = $request;
        return 1;
    }

    public static function getRequest(): string
    {
        return self::$request;
    }

    //Get
    public static function setGet($get):int
    {
        self::$get = $get;
        return 1;
    }

    public static function getGet(): string
    {
        return self::$get;
    }

    public static function addGet($add_get):string
    {
        $get = self::getGet();
        $get_arr_old = [];
        if ($get != '') {
            $get_arr_old = explode('&', self::getGet());
        }
        $get_arr_new = [];
        foreach ($get_arr_old as $get) {
            $get_arr = explode('=', $get);
            if (isset($get_arr[0])) {
                if (!isset($get_arr[1])) {
                    $get_arr[1] = '';
                }
                $get_arr_new[$get_arr[0]] = $get_arr[1];
            }
        }
        foreach ($add_get as $get) {
            $get_arr = explode('=', $get);
            if (isset($get_arr[0])) {
                if (!isset($get_arr[1])) {
                    $get_arr[1] = '';
                }
                $get_arr_new[$get_arr[0]] = $get_arr[1];
            }
        }
        $get_arr = [];
        foreach ($get_arr_new as $k=>$v) {
            $get_str = $k . '=' . $v;
            array_push($get_arr, $get_str);
        }
        self::$get = implode('&', $get_arr);
        return self::$get;
    }

    public static function unsetGet($unset_get):string
    {
        $get = self::getGet();
        $get_arr_old = [];
        if ($get != '') {
            $get_arr_old = explode('&', self::getGet());
        }
        $get_arr_new = [];
        foreach ($get_arr_old as $get) {
            $get_arr = explode('=', $get);
            if (isset($get_arr[0])) {
                if (!isset($get_arr[1])) {
                    $get_arr[1] = '';
                }
                $get_arr_new[$get_arr[0]] = $get_arr[1];
            }
        }
        foreach ($unset_get as $get) {
            $get_arr = explode('=', $get);
            if (isset($get_arr[0])) {
                if (!isset($get_arr[1])) {
                    $get_arr_new = array_diff_key($get_arr_new, [$get_arr[0] => '']);
                } else {
                    if ($get_arr_new[$get_arr[0]] == $get_arr[1]) {
                        $get_arr_new = array_diff_key($get_arr_new, [$get_arr[0] => $get_arr[1]]);
                    }
                }
            }
        }
        $get_arr = [];
        foreach ($get_arr_new as $k=>$v) {
            $get_str = $k . '=' . $v;
            array_push($get_arr, $get_str);
        }
        self::$get = implode('&', $get_arr);
        return self::$get;
    }

    //UserRoles
    public static function setUserRoles($value):int
    {
        self::$userRoles = $value;
        return int;
    }

    public static function addUserRole($value):int
    {
        foreach (self::$userRoles as $ur) {
            if ($ur == $value) {
                return 2;
            }
        }
        self::$userRoles[] = $value;
            return 1;
    }

    public static function getUserRoles(): array
    {
        return self::$userRoles;
    }

    public static function getUserRole($value):int
    {
        foreach (self::$userRoles as $ur) {
            if ($ur == $value) {
                return 1;
            }
        }
            return 0;
    }

    public static function cleanUserRoles():int
    {
        self::$userRoles = [];
        return 1;
    }

    public static function unsetUserRole($value):array
    {
        if (array_key_exists($value, self::$userRoles)) {
            array_diff(self::$userRoles, $value);
            return 1;
        }
        return 2;
    }

    //Labels
    public static function addLabel($key, $value):int
    {
        if (array_key_exists($key, self::$labels)) {
            self::$labels[$key] = $value;
            return 2;
        }
        self::$labels[$key] = $value;
        return 1;
    }

    public static function getLabel($key):string
    {
        return self::$labels[$key] ?? $key;
    }

    public static function getLabels():array
    {
        return self::$labels;
    }

    //Error
    public static function addError($key, $value):int
    {
        if (array_key_exists(self::$errors, $key)) {
            self::$errors[$key] = $value;
            return 2;
        }
        self::$errors[$key] = $value;
        return 1;        
    }

    public static function getError($key):string
    {
        return self::$errors[$key] ?? '';
    }

    public static function getErrors():array
    {
        return self::$errors;
    }

    //Settings
    public static function addSetting($key, $value):int
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
        return 1;       
    }

    public static function getSetting($key)
    {
        return self::$settings[$key] ?? null;
    }

    public static function getSettings():array
    {
        return self::$settings;
    }

    //Modules
    public static function addModul($name, $params):int
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
        return 1;
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

    public static function getModules():array
    {
        return self::$modules;
    }

    public static function updateModul($modul):int
    {
        foreach ( self::$modules as $key => $value) {
            if ( array_key_exists('name', $value) ) {
                if ( $modul['name'] == $value['name'] ) {
                    self::$modules[$key] = $modul;
                }
            }
        }
        return 1;
    }

    //Widgets
    public static function addWidget($name, $params):int
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
            $widget = array_merge(['name' => $name, 'complete' => false, 'object' => null, 'code' => ''], $params);
            if ($pos) {
                array_push($result, $widget);
            } else {
                array_unshift($result, $widget);
            }
        }
        self::$widgets = $result;
        return 1;
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

    public static function getWidgets():array
    {
        return self::$widgets;
    }

    public static function updateWidget($widget):int
    {
        foreach ( self::$widgets as $key => $value) {
            if ( array_key_exists('name', $value) ) {
                if ( $widget['name'] == $value['name'] ) {
                    self::$widgets[$key] = $widget;
                }
            }
        }
        return 1;
    }

}
