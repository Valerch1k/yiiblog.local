<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.11.2017
 * Time: 21:49
 */

namespace app\models;


use Yii;
use yii\base\Model;

class CommentForm extends Model
{

    public  $message;

    public function rules()
    {
        return [
            ['message', 'required', 'message' => 'Сообщение не должно быть пустым !'],
        ];
    }

    public function saveComment($idArticle)
    {
        $comment = new Comment();
        $comment->text = $this->message;
        $comment->user_id =  Yii::$app->user->id ;  //
        $comment->article_id = $idArticle;
        $comment->date = date('Y-m-d');
        $comment->status = 0;

        return $comment->save();
    }

}