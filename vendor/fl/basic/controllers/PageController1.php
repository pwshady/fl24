<?php

namespace fa\basic\controllers;

use fa\App;

class PageController extends Controller
{



























    public function getParams($name)
    {
        $params = [];
        foreach ( $_GET as $key => $value ) {
            if ( str_starts_with($key, $name ) ) {
                $key_arr = explode('-', $key, 3);
                $params[$key_arr[2]] = ['value' => $value, 'method' => 'GET'];
            }
        }
        foreach ( $_POST as $key => $value ) {
            if ( str_starts_with($key, $name ) ) {
                $key_arr = explode('-', $key, 3);
                $params[$key_arr[2]] = ['value' => $value, 'method' => 'POST'];
            }
        }
        return $params;
    }








}