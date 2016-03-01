<?php

namespace vladkukushkin\faq;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\VarDumper;
use yii\web\NotFoundHttpException;

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
     * @var string Directory URL address, where images files are stored. 'http://my_site_name/upload/faq/'
     */
    public $imagesUrl = '';

    /**
     * @var string Alias or absolute path to directory where images files are stored. '@frontend/web/upload/faq/'
     */
    public $imagesPath =  '';

    /**
     * @var string Language selector for ImperaviWidget
     */
    public $imperaviLanguage = 'ru';


    /**
     * Init module
     */
    public function init()
    {
        parent::init();
        if (!file_exists(Yii::getAlias($this->imagesPath)) || !is_writable(Yii::getAlias($this->imagesPath))) {
            throw new InvalidParamException();
        }

        $headers = @get_headers($this->imagesUrl);
        if (strpos($headers[0], '404') !== false) {
            throw new NotFoundHttpException('Url for images folder not found');
        }

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
