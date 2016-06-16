<?php

use yii\db\Migration;

/**
 * Handles the creation for table `discount_addresses`.
 * Has foreign keys to the tables:
 *
 * - `discounts`
 * - ``
 */
class m160616_180957_create_discount_addresses extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('discount_addresses', [
            'id' => $this->primaryKey(),
            'discount_id' => $this->integer()->notNull(),
            'address_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `discount_id`
        $this->createIndex(
            'discount_idx-discount_addresses-discount_id',
            'discount_addresses',
            'discount_id'
        );

        // add foreign key for table `discounts`
        $this->addForeignKey(
            'fk-discount_addresses-discount_id',
            'discount_addresses',
            'discount_id',
            'discounts',
            'discount_id',
            'CASCADE'
        );

        // creates index for column `address_id`
        $this->createIndex(
            'idx-discount_addresses-address_id',
            'discount_addresses',
            'address_id'
        );

        // add foreign key for table ``
        $this->addForeignKey(
            'fk-discount_addresses-address_id',
            'discount_addresses',
            'address_id',
            'company_addresses',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `discounts`
        $this->dropForeignKey(
            'fk-discount_addresses-discount_id',
            'discount_addresses'
        );

        // drops index for column `discount_id`
        $this->dropIndex(
            'idx-discount_addresses-discount_id',
            'discount_addresses'
        );

        // drops foreign key for table ``
        $this->dropForeignKey(
            'fk-discount_addresses-address_id',
            'discount_addresses'
        );

        // drops index for column `address_id`
        $this->dropIndex(
            'idx-discount_addresses-address_id',
            'discount_addresses'
        );

        $this->dropTable('discount_addresses');
    }
}
