<?php

use yii\db\Migration;

/**
 * Handles the creation for table `comments`.
 */
class m160630_173150_create_comments extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comments', [
            'id'     => $this->primaryKey(),
            'discount_id' => $this->integer()->notNull(),
            'user_id' => $this->integer(),
            'name'   => $this->string(255)->notNull(),
            'text'   => $this->text()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(0)->comment('0/1 moderate/active'),
            'deleted' => $this->integer()->notNull()->defaultValue(0)->comment('0/1 active/deleted'),
        ]);

        // creates index for column `discount_id`
        $this->createIndex(
            'idx-comments-discount_id',
            'comments',
            'discount_id'
        );

        // add foreign key for table `discounts`
        $this->addForeignKey(
            'fk-comments-discount_id',
            'comments',
            'discount_id',
            'discounts',
            'discount_id',
            'CASCADE'
        );

        // creates index for column `discount_id`
        $this->createIndex(
            'idx-comments-user_id',
            'comments',
            'user_id'
        );

        // add foreign key for table `discounts`
        $this->addForeignKey(
            'fk-comments-user_id',
            'comments',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comments');
    }
}
