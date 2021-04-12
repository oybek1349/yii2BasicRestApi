<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m210411_063715_create_currency_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%currency}}', [
            'id' => $this->primaryKey(),
            'valuteID' => $this->char(50)->notNull()->defaultValue(null),
            'numCode' => $this->char(50)->notNull()->defaultValue(null),
            'charCode' => $this->char(50)->notNull()->defaultValue(null),
            'name' => $this->string()->notNull()->defaultValue(null),
            'value' => $this->char(20)->notNull()->defaultValue(null),
            'date' => $this->integer()->notNull()->defaultValue(null),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=MyISAM');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%currency}}');
    }
}
