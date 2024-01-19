<?php

namespace fl\basic\models;

use fl\App;

class Model
{

    protected string $dir;

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function run(){}

    protected function setAccess()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {       
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json'), true);
            if ($access != '') {
                App::$app->addUserRole($access);
            }
        }
    }

    protected function setErrors()
    {
        if (file_exists(ROOT . $this->dir . 'errors.json')) {
            $errors = json_decode(file_get_contents(ROOT . $this->dir . 'errors.json'), true);
            if (is_array($errors)) {
                foreach ($errors as $key => $value) {
                    App::$app->setError($key, $value);
                }
            }
        }
    }

    protected function setSettings()
    {
        if (file_exists(ROOT . $this->dir . 'settings.json')) {       
            $settings = json_decode(file_get_contents(ROOT . $this->dir . 'settings.json'), true);
            if (is_array($settings)) {
                foreach ($settings as $key => $value) {
                    foreach ($value as $key => $value) {
                        App::$app->addSetting($key, $value);
                    }
                }
            }
        }
    }

    protected function setLabels()
    {
        if (file_exists($this->dir . '/labels.json')) {            
            $labels = json_decode(file_get_contents($this->dir . '/labels.json'), true);
            if (is_array($labels)) {
                $language = App::$app->getLanguage()['code'];
                if (array_key_exists($language, $labels)) {
                    return $labels[$language];
                } else {
                    foreach ( $labels as $key => $value) {
                        return $value;
                    }
                }
            }
        }
    }

    protected function setModules()
    {
        if (file_exists(ROOT . $this->dir . 'modules.json')) {
            $modules = json_decode(file_get_contents(ROOT . $this->dir . 'modules.json'), true);
            if (is_array($modules)) {
                foreach ($modules as $key => $value) {
                    App::$app->setModul($key, $value);
                }
            }            
        }
    }

    protected function setWidgets()
    {
        if (file_exists(ROOT . $this->dir . 'widgets.json')) {
            $widgets = json_decode(file_get_contents(ROOT . $this->dir . 'widgets.json'), true);
            if (is_array($widgets)) {
                foreach ($widgets as $key => $value) {
                    App::$app->setWidget($key, $value);
                }
            }            
        }
    }

}
