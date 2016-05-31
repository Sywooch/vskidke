<?php

use yii\db\Migration;

/**
 * Handles the creation for table `sities`.
 */
class m160531_183401_create_sities extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('sities', [
            'city_id' => $this->primaryKey(),
            'city_name' => $this->string(150),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('sities');
    }
}
