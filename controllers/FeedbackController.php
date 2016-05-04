<?php

namespace app\controllers;

use Yii;
use app\models\FeedbackMessages;
use app\models\FeedbackThemes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeedbackController implements the CRUD actions for FeedbackMessages model.
 */
class FeedbackController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Creates a new FeedbackMessages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	 
    public function actionIndex()
    {
        $model = new FeedbackMessages();
		$themes =  FeedbackThemes::find()->select(['theme_name', 'theme_id'])->indexBy('theme_id')->column();
		
		if ($model->load(Yii::$app->request->post())) {
            $file = $model->uploadFile();
			
            if ($model->validate() && $model->save()) {
                if ($file !== false) {
                    $path = $model->getFile();
                    $file->saveAs($path);
					
					return $this->redirect(['feedback/view', 'id' => $model->primaryKey]);
                }
            } else {
                var_dump($model->getErrors());
            }
        }

        return $this->render('create', ['model'=>$model, 'themes'=>$themes]);
    }
	
	public function actionAll()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FeedbackMessages::find(),
			'pagination' => [
                'pageSize' => 3,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single FeedbackMessages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);	
		//var_dump($model->theme->theme_name); die();	
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new FeedbackMessages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FeedbackMessages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->message_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FeedbackMessages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->message_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing FeedbackMessages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the FeedbackMessages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FeedbackMessages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FeedbackMessages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
