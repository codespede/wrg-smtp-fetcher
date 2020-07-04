<?php

namespace app\controllers;

use Yii;
use app\models\Emails;
use app\models\search\EmailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmailsController implements the CRUD actions for Emails model.
 */
class EmailsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        // var_dump(Yii::$app->emailManager); die;
        // $connect_to = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
        //     $connection = \imap_open($connect_to, 'harveyspect60@gmail.com', 'zwukybktspqnzwqk')
        //     or die("Can't connect to '$connect_to': " . imap_last_error());
        // $MC = imap_check($connection);
        // $result = imap_fetch_overview($connection, "1:{$MC->Nmsgs}", 0);
        // //imap_delete($connection, 3, FT_UID);
        // $body = imap_fetchbody($connection, 3, 1, FT_PEEK);
        // imap_close($connection);
        // var_dump($result[0], date('Y-m-d H:i:s', strtotime($result[0]->date))); die;
        //var_dump(Yii::$app->emailManager->save()); die;
        $searchModel = new EmailsSearch();
        //var_dump(Yii::$app->request->queryParams); die;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $email = $this->findModel($id);
        Yii::$app->logger->log('view', 'user', $email->uid);
        return $this->render('view', [
            'model' => $email,
        ]);
    }

    /**
     * Creates a new Emails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Emails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Emails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $email = $this->findModel($id);
        Yii::$app->emailManager->delete($email->uid);
        $email->delete();
        Yii::$app->logger->log('delete', 'user', $email->uid);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Emails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
