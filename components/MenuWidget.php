<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.10.2017
 * Time: 20:03
 */

namespace app\components;

use app\models\Category;
use Yii;
use yii\base\Widget;

class MenuWidget extends Widget
{

    public function run()
    {
        //определяем название контроллера и метода (action)
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $id =  Yii::$app->request->getQueryParam('id');
        // находим все категории для меню
        $categories = Category::find()->all();

        return $this->render('Menu',array(
            'categories'=>$categories,
            'controller'=>$controller ,
            'action'=>$action,
            'id'=>$id
        ));
    }


}