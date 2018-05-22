<?php

use yii\db\Migration;

/**
 * Handles the creation of table `artical_tag`.
 */
class m170905_174334_create_artical_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_tag', [
            'id' => $this->primaryKey(),
            'article_id'=>$this->integer(),
            'tag_id'=>$this->integer()
        ]);
        $this->createIndex(
            'idx-article_id',
            'article_tag',
            'article_id'
        );
        $this->createIndex(
            'idx-tag_id',
            'article_tag',
            'tag_id'
        );
        $this->addForeignKey(
            'fk-article_tag_article_id',
            'article_tag',
            'article_id',
            'article',
            'id',
            'cascade'
        );
        $this->addForeignKey(
            'fk-article_tag_tag_id',
            'article_tag',
            'tag_id',
            'tag',
            'id',
            'cascade'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('artical_tag');
    }
}
