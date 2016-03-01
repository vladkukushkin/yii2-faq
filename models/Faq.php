<?php

namespace vladkukushkin\faq\models;

use Yii;
use vladkukushkin\faq\Module;
use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "{{%faq}}".
 *
 * @property integer $faq_id
 * @property string $faq_title
 * @property string $faq_text
 * @property string $faq_language
 * @property integer $faq_show_on_main
 */
class Faq extends ActiveRecord
{
    const SHOW_ON_MAIN = 1;
    const NOT_SHOW_ON_MAIN = 0;
    
    public static function getVisibleOnMain()
    {
        return [
            self::NOT_SHOW_ON_MAIN => Module::t('faq', 'NOT_SHOW_ON_MAIN'),
            self::SHOW_ON_MAIN => Module::t('faq', 'SHOW_ON_MAIN'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%faq}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_title', 'faq_text'], 'required'],
            [['faq_text', 'faq_language'], 'string'],
            [['faq_text'], 'trim'],
            [['faq_show_on_main'], 'integer'],
            [['faq_show_on_main'], 'in', 'range' => [self::SHOW_ON_MAIN, self::NOT_SHOW_ON_MAIN]],
            [['faq_show_on_main'], 'default', 'value' => self::NOT_SHOW_ON_MAIN],
            [['faq_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'faq_id' => Module::t('faq', 'FAQ_ID'),
            'faq_title' => Module::t('faq', 'FAQ_HEADER'),
            'faq_text' => Module::t('faq', 'FAQ_CONTENT'),
            'faq_language' => Module::t('faq', 'FAQ_LANGUAGE'),
            'faq_show_on_main' => Module::t('faq', 'FAQ_IS_SHOW_ON_MAIN'),
        ];
    }

    public static function getLanguageFilter()
    {
        $languages = (new Query())
            ->select('DISTINCT(faq_language)')
            ->from('{{%faq}}')
            ->column();
        $filter = [];
        if ($languages) {
            foreach ($languages as $language) {
                $filter[$language] = $language;
            }
        }
        return $filter;
    }
}
