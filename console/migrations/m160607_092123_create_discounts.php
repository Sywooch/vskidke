<?php

use yii\db\Migration;

/**
 * Handles the creation for table `discounts`.
 */
class m160607_092123_create_discounts extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('discounts', [
            'discount_id'         => $this->primaryKey(),
            'user_id'             => $this->integer()->notNull(),
            'category_id'         => $this->integer()->notNull(),
            'city_id'             => $this->integer(),
            'discount_title'      => $this->string(255)->notNull(),
            'discount_text'       => $this->text()->notNull(),
            'discount_date_start' => $this->date()->notNull(),
            'discount_date_end'   => $this->date()->notNull(),
            'discount_app'        => $this->integer()->defaultValue(0)->comment('0/1 not add/add app'),
            'discount_view_email' => $this->integer()->defaultValue(0)->comment('view email on discount(0/1 view/not view)'),
            'discount_price'      => $this->integer(),
            'discount_old_price'  => $this->integer(),
            'discount_percent'    => $this->integer(),
            'img'                 => $this->string(255)
        ]);

        $this->createIndex(
            'discount_idx-discounts-user_id',
            'discounts',
            'user_id'
        );

        $this->addForeignKey(
            'fk-discounts-user_id',
            'discounts',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'discount_idx-discounts-category_id',
            'discounts',
            'category_id'
        );

        $this->addForeignKey(
            'fk-discounts-category_id',
            'discounts',
            'category_id',
            'categories',
            'category_id',
            'CASCADE'
        );

        $this->createIndex(
            'discount_idx-discounts-city_id',
            'discounts',
            'city_id'
        );

        $this->addForeignKey(
            'fk-discounts-city_id',
            'discounts',
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
        $this->dropTable('discounts');
    }
}
