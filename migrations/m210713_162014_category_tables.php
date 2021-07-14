<?php

use yii\db\Migration;

/**
 * Class m210713_162014_category_tables
 */
class m210713_162014_category_tables extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(null),
            'name' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()
        ]);

        $this->addForeignKey('category_fk1', 'category', 'parent_id', 'category', 'id', 'RESTRICT', 'RESTRICT');
        $this->createIndex('category_idx1', 'category', ['parent_id']);

        $this->addCommentOnTable('category', 'Категории');
        $this->addCommentOnColumn('category','parent_id', 'Родитель');
        $this->addCommentOnColumn('category','name', 'Название');
        $this->addCommentOnColumn('category','created_at', 'Создано');
        $this->addCommentOnColumn('category','updated_at', 'Обновлено');
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
