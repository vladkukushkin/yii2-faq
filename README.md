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
                    'imagesPath' => '@frontend/web/upload/faq/',//realpath(__DIR__.'/../../frontend/web/upload/faq/')
                ],
    ],
```
You should use 'imagesUrl' and 'imagesPath' to define folder to store your images for FAQ.
This variables should define same directory.
In above example images will be saved in '@frontend/web/upload/faq' directory.
You should define both variables because [Imperavi widget](https://github.com/vova07/yii2-imperavi-widget)
used in this module and they needed to this widget.

If you use advanced project template you should configure both config.php
with the same values

You can add link to this module in your backend navbar:
```php
$menuItems[] = ['label' => 'FAQ', 'url' => ['/faq/default/index']];
```
 
To display FAQ just add:
```php
echo \vladkukushkin\faq\widgets\FaqWidget\FaqWidget::widget();
```
Widget have two parameters - 'title' and 'breadcrumbs' with default value 'false',
which means that no title and no breadcrumbs will be applied on page with widget.
It is useful if you will place widget on existing page with other information.
If you locate widget on separate page and want to specify title or breadcrumbs
(or maybe both of them) you can call widget like this:
```php
echo \vladkukushkin\faq\widgets\FaqWidget\FaqWidget::widget([
    'title' => Yii::t('app', 'FAQ'),
    'breadcrumbs' => Yii::t('app', 'FAQ page'),
]);
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