<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\ImageUpload;
use app\models\Tag;
use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSetImage($id)
    {
        $model = new ImageUpload();

        // если нажали на кнопку загрузить картинку
        if(Yii::$app->request->isPost)
        {
            // находим статью в бд
            $article = $this->findModel($id);
            // о_О
            $file = UploadedFile::getInstance($model,'image');
            // сохраняем инфо про файл в бд и загружаем картинку  на сервер
          if( $article->saveImage($model->uploadFile($file,$article->image)))
          {
              return $this->redirect(['view','id'=>$article->id]);
          }

        }
        return $this->render('image',['model'=>$model]);
    }

    public  function actionSetCategory($id)
    {
        $article = $this->findModel($id);

        $selectedCategory = $article->category->id;

        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if(Yii::$app->request->isPost)
        {
            $category_id = Yii::$app->request->post('category');
            if( $article->saveCategory($category_id))
            {
                return $this->redirect(['view','id'=>$article->id]);
            }

        }

        return $this->render('category',[
            'article'=>$article,
            'selectedCategory'=>$selectedCategory,
            'categories'=>$categories
        ]);
    }

    public function actionSetTags($id)
    {
        // находим статью по id
        $article = $this->findModel($id);
        // находим связанные tags_id данной статьи
        $selectedTags = $article->getSelectedTags();
        // получаем все теги бд
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');
        // если форма была отправлена
        if(Yii::$app->request->isPost)
        {
            // получаем выбранные  id тегов из инпута tags
            $tags_id = Yii::$app->request->post('tags');
            $article->saveTags($tags_id);
            $this->redirect(['view','id'=>$article->id]);
        }

        return $this->render('tags',[
            'article'=>$article,
            'selectedTags'=>$selectedTags,
            'tags'=>$tags
        ]);


    }




}
