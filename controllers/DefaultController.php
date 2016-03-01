<?php

namespace vladkukushkin\faq\controllers;

use vladkukushkin\faq\Module;
use yii\web\Controller;
use Yii;
use vladkukushkin\faq\models\Faq;
use vladkukushkin\faq\models\search\FaqSearch;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Faq model.
 */
class DefaultController extends Controller
{
    /**
     * Defines the controller behaviors
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->accessRoles,
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        parent::actions();
        /*
         * http://www.yiiframework.ru/forum/viewtopic.php?t=22866#p141006
         * "url" - this is the link to web-accessible folder where file will be stored. At this time file will be uploaded
         * in temporary folder, that`s why URL is temporary to.
         * "path" - this is the path to temporary folder where file will be uploaded. At the beginning widget load file to
         * the temporary folder which defined by variable "path". And when you save record file will be moved to constant
         * folder. You should define same folders.
         * "url" - это ссылка к директории с веб доступом в которой будет загружен сам файл. Подразумевается что
         * в конкретно данной ситуации загрузка происходит во временную папку, по этому и УРЛ будет временным.
         * "path" - это путь к временной папке куда будет загружен файл. Данный виджет имеет такую логику что он
         * предварительно загружает файл в временную папку, именно в той что указано в "path". И только при сохранении
         * он перемещает файл в постоянную папку. надо указывать одну и туже папку
         */
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => $this->module->imagesUrl, // Directory URL address, where files are stored.
                'path' => $this->module->imagesPath, // Or absolute path to directory where files are stored.
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => $this->module->imagesUrl, // Directory URL address, where files are stored.
                'path' => $this->module->imagesPath, // Or absolute path to directory where files are stored.
                'type' => \vova07\imperavi\actions\GetAction::TYPE_IMAGES,
            ],
        ];
    }
    /**
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Faq model.
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
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->faq_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->faq_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Faq model.
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
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

