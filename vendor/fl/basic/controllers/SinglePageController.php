<?php

namespace fl\basic\controllers;

use fl\App;

class SinglePageController extends PageController
{

    public function run()
    {
        App::$app->setSingle();
        self::job();
        self::getView();
    }

    public function getView()
    {
        if ( file_exists(ROOT . $this->page_dir . 'View.php' )) {
            self::runView();
        } else {
            $view_name = App::$app->getSetting('view') ? App::$app->getSetting('view') : 'index';
            if ( file_exists(ROOT . $this->page_dir . $view_name . 'View.php') ) {
                self::createdView($view_name);
            } else {
                if (App::$app->getError('1001') !== '') {                        
                    $controller = new PageController('/app/pages', explode('/', App::$app->getError('1001')), []);
                } else {
                    $controller = new PageController('/app/pages', ['samples', 'single'], []);
                }
                $controller->run();
            }
        }
    }



}