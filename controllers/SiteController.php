<?php

namespace app\controllers;

use app\models\Article;
use app\models\ArticleTag;
use app\models\Category;
use app\models\Comment;
use app\models\CommentForm;
use app\models\Tag;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        //  получаем новые статьи
        $query = Article::find()->orderBy('date asc')->limit(9)->where(['status'=>1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=> 9 ]);
        $articleIsNew = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        // получаем  популярные статьи
        $articleIsPopular = Article::find()->orderBy('viewed desc')->all();


        return $this->render('index', [
            'articleIsNew' => $articleIsNew,
            'articleIsPopular'=>$articleIsPopular,
            'pages' => $pages
        ]);

    }
//    вывод всех статей по связанной категории $id
    public function actionCategories($id){
        // категория для breadcrumbs
        $category = Category::find()->where(['id'=>$id])->one();

        $query = Article::find()->where(['category_id' => $id,'status'=>1]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=> 9 ]);
        $article = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('categories',[
            'article'=>$article,
            'pages' => $pages,
            'category'=>$category
        ]);
    }

    // полный вывод статьи
    public function actionView($id) {
        // получаем статью
        $article = Article::find()->where(['id'=>$id])->one();
        // находим связанные tags данной статьи
        $tags = $article->getTags()->all();

        //получаем комментарии
        $pages = new Pagination(['totalCount' =>$article->getComment()->count(),'pageSize'=> 9 ]);
        $comments = $article->getComment()->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $commentForm = new CommentForm();

        return $this->render('view',[
            'article'=>$article,
            'tags'=>$tags,
            'comments'=>$comments,
            'pages'=>$pages,
            'commentForm'=>$commentForm
        ]);
    }
    // вывод статей по связанному тегу $id
    public function actionTags($id){

        $tag = Tag::find()->limit(1)->where(['id'=>$id])->one();
        $pages = new Pagination(['totalCount' => $tag->getArticle()->count(),'pageSize'=> 9 ]);
        $article = $tag->getArticle()->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('categories',[
            'article'=>$article,
            'pages' => $pages,
        ]);

    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                // все данные корректны
                $model->saveComment($id);
                return $this->redirect(['site/view','id'=>$id]);
            }
            else
            {
                // данные не корректны: $errors - массив содержащий сообщения об ошибках
                $errors = $model->errors;
                // получаем статью
                 $article = self::getOneArticle($id);
                // находим связанные tags данной статьи
                $tags = $article->getTags()->all();
                //получаем комментарии
                $pages = new Pagination(['totalCount' =>$article->getComment()->count(),'pageSize'=> 9 ]);
                $comments = $article->getComment()->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();


                $commentForm = new CommentForm();

                return $this->render('view',[
                    'article'=>$article,
                    'tags'=>$tags,
                    'comments'=>$comments,
                    'pages'=>$pages,
                    'commentForm'=>$commentForm,
                    'errors'=>$errors
                ]);
            }
        }
    }

    public static function getOneArticle($id)
    {
      return   Article::find()->where(['id'=>$id])->one();
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

}
