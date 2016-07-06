<?php

use yii\db\Migration;

/**
 * Handles the creation for table `banners`.
 */
class m160706_190900_create_banners extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('banners', [
            'id' => $this->primaryKey(),
            'img' => $this->string(255)->defaultValue(null),
            'position' => $this->integer()->notNull()->comment('1/2/3 left/right/top'),
            'link' => $this->string(255)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('banners');
    }
}
