<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_addresses`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `sities`
 */
class m160615_085419_create_company_addresses extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_addresses', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'address' => $this->text(),
            'phone' => $this->string(50),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-company_addresses-user_id',
            'company_addresses',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-company_addresses-user_id',
            'company_addresses',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `city_id`
        $this->createIndex(
            'city_idx-company_addresses-city_id',
            'company_addresses',
            'city_id'
        );

        // add foreign key for table `sities`
        $this->addForeignKey(
            'fk-company_addresses-city_id',
            'company_addresses',
            'city_id',
            'sities',
            'city_id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-company_addresses-user_id',
            'company_addresses'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-company_addresses-user_id',
            'company_addresses'
        );

        // drops foreign key for table `sities`
        $this->dropForeignKey(
            'fk-company_addresses-city_id',
            'company_addresses'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            'city_idx-company_addresses-city_id',
            'company_addresses'
        );

        $this->dropTable('company_addresses');
    }
}
