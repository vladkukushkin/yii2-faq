<?php

namespace vladkukushkin\faq;

use Yii;

/**
 * @author Vladislav Kukushkin <vladkuk7070@gmail.com>
 */

class Module extends \yii\base\Module
{
    /**
     * @var string The controller namespace to use
     */
    public $controllerNamespace = 'vladkukushkin\faq\controllers';

    /**
     * @var string source language for translation
     */
    public $sourceLanguage = 'en-US';

    /**
     * @var null|array The roles which have access to module controllers, eg. ['admin']. If set to `null`, there is no accessFilter applied
     */
    public $accessRoles = null;


    /**
     * Init module
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    /**
     * Registers the translation files
     */
    protected function registerTranslations()
    {
        Yii::$app->i18n->translations['extensions/yii2-faq/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => $this->sourceLanguage,
            'basePath' => '@vendor/vladkukushkin/yii2-faq/messages',
            'fileMap' => [
                'extensions/yii2-faq/faq' => 'faq.php',
            ],
        ];
    }

    /**
     * Translates a message. This is just a wrapper of Yii::t
     *
     * @see Yii::t
     *
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        Yii::$app->getModule('faq')->registerTranslations();
        return Yii::t('extensions/yii2-faq/' . $category, $message, $params, $language);
    }
}
