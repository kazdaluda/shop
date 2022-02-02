<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%shop_reviews}}`.
 */
class m210412_214331_add_product_column_to_shop_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_reviews}}', 'product', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_reviews}}', 'product');
    }
}
