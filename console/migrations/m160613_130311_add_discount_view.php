<?php

use yii\db\Migration;

class m160613_130311_add_discount_view extends Migration
{
    public function up()
    {
        $this->addColumn('discounts', 'discount_view', $this->integer()->notNull()->after('city_id'));
    }

    public function down()
    {
        $this->dropColumn('discounts', 'discount_view');
    }
}
