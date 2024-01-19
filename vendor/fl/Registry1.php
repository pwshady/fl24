<?php

namespace fl;

class Registry

{





















 
























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