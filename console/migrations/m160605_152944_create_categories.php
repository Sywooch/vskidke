<?php

use yii\db\Migration;

/**
 * Handles the creation for table `categories`.
 */
class m160605_152944_create_categories extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('categories', [
            'category_id' => $this->primaryKey(),
            'category_name' => $this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('categories');
    }
}
