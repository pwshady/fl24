<?php

namespace fl\basic\views;

use fl\App;

class PageView extends View
{
    public function __construct(){}

    public function run(){}

    public function render()
    {
        $labels = App::$app->getLabels();
        $widgets = App::$app->getWidgets();
        foreach ( $widgets as $widget) {
            if ( array_key_exists('name', $widget) && array_key_exists('code', $widget) ) {
                $name = 'w_' . $widget['name'];
                $$name = $widget['code'];
            }
        }
        ob_start();
        $path = ROOT . '/app/pages/' . App::$app->getPage();
        if (App::$app->getSingle()) {
            $path .= '/_/'; 
        } else {
            $path .= '/__/'; 
        }
        require_once $path . 'indexView.php';
        return ob_get_clean();
    }

}