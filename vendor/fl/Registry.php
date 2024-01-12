<?php

namespace fl;

class Registry

{

    use traits\TSingleton;

    private static string $url = '';
    private static string $land = '';
    private static string $language = '';
    private static string $page = '';
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
        if (array_key_exists(self::$labels, $key)) {
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


}
