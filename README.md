# yii2-faq-module
FAQ module for Yii2

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vladkukushkin/yii2-faq "*"
```

or add

```
"vladkukushkin/yii2-faq": "*"
```

to the require section of your composer.json file.

## Usage

You should add module to your config:

```php
'modules' => [
        ...
        'faq' => \vladkukushkin\faq\Module::className(),
    ],
```
If you use advanced project template you should configure both config.php
 
To display FAQ just add:
```php
echo \vladkukushkin\faq\widgets\FaqWidget\FaqWidget::widget();
```

You should define folder to store your images fo FAQ. You can make it by modifying
DefaultController.php in public function actions().
There is [Imperavi widget](https://github.com/vova07/yii2-imperavi-widget)
used in this module.

It is possible that you have to change minimum stability section of your 
composer.json file to dev
```php
"minimum-stability": "dev",
```

