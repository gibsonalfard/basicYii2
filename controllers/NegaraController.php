<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Country;
use yii\web\NotFoundHttpException;

class NegaraController extends ActiveController{
    public $modelClass = 'app\models\Country';

    protected function verbs()
    {
        return [
            'remove' => ['DELETE'],
            'get' => ['GET','HEAD'],
            'show' => ['GET'],
            'add' => ['POST']
        ];
    }

    /* 
        Mengambil Seluruh Negara yang ada di dalam basis data
        Author          : Ilham Gibran
        Date of Edit    : 5 March 2020  
    */
    public function actionShow(){
        $query = Country::find()->asArray()->all();

        return $query;
    }

    /* 
        Mengambil Data Negara berdasarkan ID yang diparsing, 
        $id dapat diganti dengan variable lain, nanti akan berpengaruh
        saat parsing paramater untuk Request
        Author          : Ilham Gibran
        Date of Edit    : 5 March 2020
    */
    public function actionGet($id){
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');

        return $model;
    }

    public function actionAdd(){
        $model = new Country();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $model;
        }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);
    }
}