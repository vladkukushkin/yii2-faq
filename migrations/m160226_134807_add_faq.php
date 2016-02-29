<?php

use yii\db\Migration;
use vladkukushkin\faq\models\Faq;

class m160226_134807_add_faq extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%faq}}', [
            'faq_id' => $this->primaryKey(),
            'faq_title' => $this->string()->notNull(),
            'faq_text' => $this->text()->notNull(),
            'faq_language' => $this->string(5)->notNull()->defaultValue(Yii::$app->language),
            'faq_show_on_main' => $this->smallInteger()->defaultValue(Faq::NOT_SHOW_ON_MAIN),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%faq}}');
    }

}
