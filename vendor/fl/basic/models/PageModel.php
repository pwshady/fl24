<?php

namespace fl\basic\models;

use fl\App;

class PageModel extends Model
{

    public function run()
    {
        self::setAccess();
        self::setErrors();
        self::setSettings();
        self::setLabels();
        self::setModules();
        self::setWidgets();
    }

    protected function setLabels()
    {
        if (file_exists(ROOT . $this->dir . 'labels.json')) {            
            $labels = json_decode(file_get_contents(ROOT . $this->dir . 'labels.json'), true);
            if (is_array($labels)) {
                $language = App::$app->getLanguage();
                if (array_key_exists($language, $labels)) {
                    $labels = $labels[$language];
                    foreach ($labels as $key => $value) {
                        App::$app->addLabel($key, $value);
                    }
                }
            }
        }
    }

}
