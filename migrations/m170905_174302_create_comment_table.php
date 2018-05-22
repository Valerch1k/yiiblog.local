<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m170905_174302_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'text'=>$this->string(),
            'user_id'=>$this->integer(),
            'article_id'=>$this->integer(),
            'status'=>$this->integer()
        ]);

        $this->createIndex(
            'idx-article_id',
            'comment',
            'article_id'
        );
        $this->createIndex(
            'idx-user_id',
            'comment',
            'user_id'
        );
        $this->addForeignKey(
            'fk-comment_article_id',
            'comment',
            'article_id',
            'article',
            'id',
            'cascade'
        );
        $this->addForeignKey(
            'fk-comment_user_id',
            'comment',
            'user_id',
            'user',
            'id',
            'cascade'
        );
    }


    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
