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

Make migration
```php
php yii migrate --migrationPath=@vendor/vladkukushkin/yii2-faq/migrations/
```

## Usage

You should add module to your config:

```php
'modules' => [
        ...
        'faq' => [
                    'class' => \vladkukushkin\faq\Module::className(),
                    'imagesUrl' => 'http://my_site_name/upload/faq/',
                    'imagesPath' => '@frontend/web/upload/faq/',//realpath(__DIR__.'/../../../frontend/web/upload/faq/'
                ],
    ],
```
You should use 'imagesUrl' and 'imagesPath' to define folder to store your images for FAQ.
This variables should define same directory.
In above example images will be saved in '@frontend/web/upload/faq' directory.
You should define both variables because [Imperavi widget](https://github.com/vova07/yii2-imperavi-widget)
used in this module and they needed to this widget.

If you use advanced project template you should configure both config.php

You can add link to this module in your backend navbar:
```php
$menuItems[] = ['label' => 'FAQ', 'url' => ['/faq/default/index']];
```
 
To display FAQ just add:
```php
echo \vladkukushkin\faq\widgets\FaqWidget\FaqWidget::widget();
```

It is possible that you have to change minimum stability section of your 
composer.json file to dev
```php
"minimum-stability": "dev",
```

Module support Russian and English languages.
By default language for Imperavi widget is Russian ('ru').
You can change it to English by adding to module config
```php
'imperaviLanguage' => 'en'
```

The module is under construction