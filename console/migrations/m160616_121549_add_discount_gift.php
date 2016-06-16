<?php

use yii\db\Migration;

class m160616_121549_add_discount_gift extends Migration
{
    public function up()
    {
        $this->addColumn('discounts', 'discount_gift', $this->text()->after('discount_percent'));
    }

    public function down()
    {
        $this->dropColumn('discounts', 'discount_gift');
    }
}
