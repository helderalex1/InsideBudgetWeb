<?php

namespace backend\controllers;

use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'view', 'registos', 'bloqueados', 'statusindex', 'statusregistospermitir',"statusbloqueados"],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'registos', 'bloqueados', 'statusindex', 'statusregistospermitir',"statusbloqueados"],
                            'roles' => ['admin'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $lista = Yii::$app->request->post();
        if(empty($lista['nome'])){
            $lista['nome'] = '';
            $user = User::find()->where(['status'=>10]);
        }else {
            $user = User::find()->where(['and', ['LIKE', 'username', $lista['nome']],['in','status', 10]]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $user,

            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'username' => SORT_ASC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegistos()
    {
        $lista = Yii::$app->request->post();
        if(empty($lista['nome'])){
        $lista['nome'] = '';
        $user = User::find()->where(['status'=>9]);
        }else {
            $user = User::find()->where(['and', ['LIKE', 'username', $lista['nome']],['in','status', 9]]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $user,

            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'username' => SORT_ASC,
                ]
            ],

        ]);

        return $this->render('registos', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionBloqueados()
    {
        $lista = Yii::$app->request->post();
        if(empty($lista['nome'])){
            $lista['nome'] = '';
            $user = User::find()->where(['status'=>0]);
        }else {
            $user = User::find()->where(['and', ['LIKE', 'username', $lista['nome']],['in','status', 0]]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $user,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'defaultOrder' => [
                    'username' => SORT_ASC,
                ]
            ],
        ]);

        return $this->render('bloqueados', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStatusindex($id){
        $user = $this->findModel($id);
        if($user->status!= 10){
            $user->status =10;
        }else{
            $user->status =0;
        }
        $user->save();
        return $this->redirect(['user/index']);
    }

    public function actionStatusregistospermitir($id){
        $user = $this->findModel($id);
        $user->status =10;
        $user->save();
        return $this->redirect(['user/registos']);
    }

    public function actionStatusregistosproibir($id){
        $user = $this->findModel($id);
        $user->status = 0;

        $user->save();
        return $this->redirect(['user/registos']);
    }

    public function actionStatusbloqueados($id){
        $user = $this->findModel($id);
        if($user->status!= 10){
            $user->status =10;
        }else{
            $user->status =0;
        }
        $user->save();
        return $this->redirect(['user/bloqueados']);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
 /*   public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
  /*  public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
*/
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
