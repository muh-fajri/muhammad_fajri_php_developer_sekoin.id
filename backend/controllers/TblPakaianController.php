<?php

namespace backend\controllers;

use Yii;

use common\models\TblPakaian;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// tambahkan
use common\models\TblKategori;
use yii\helpers\ArrayHelper;

// meng-handle upload file
use yii\web\UploadedFile;

/**
 * TblPakaianController implements the CRUD actions for TblPakaian model.
 */
class TblPakaianController extends Controller
{

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all TblPakaian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblPakaian::find(),
            'pagination' => [
                'pageSize' => 5
            ],
            /*
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            // 'urlGambar' => $model->urlGambar,
        ]);
    }

    /**
     * Displays a single TblPakaian model.
     * @param int $id ID
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
     * Creates a new TblPakaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $items = ArrayHelper::map(TblKategori::find()->all(), 'id', 'nama_kategori');
        $model = new TblPakaian();

        if ($model->load(Yii::$app->request->post())) {

            // mendefinisikan gambar yang di-upload
            $fileGambar = UploadedFile::getInstance($model, 'gambar');

            // mengecek ada file atau tidak
            if(isset($fileGambar->size)) {

                // simpan file di folder 'uploads'
                $fileGambar->saveAs('uploads/'.$fileGambar->baseName.'.'.$fileGambar->extension);

                // simpan nama file di db
                $model->gambar = $fileGambar->baseName.'.'.$fileGambar->extension;
            }            

            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'items' => $items,
            ]);
        }
    }

    /**
     * Updates an existing TblPakaian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $items = ArrayHelper::map(TblKategori::find()->all(), 'id', 'nama_kategori');
        $model = $this->findModel($id);

        // mengambil gambar yang lama dari db
        $gambarLama = $model->gambar;
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            // mendefinisikan gambar yang di-upload, diambil dari form input
            $fileGambar = UploadedFile::getInstance($model, 'gambar');

            // mengecek ada file atau tidak yang di-upload
            if(isset($fileGambar->size)) {

                if(file_exists('uploads/'.$gambarLama)) {
                    // hapus gambar lama di folder 'uploads'
                    // unlink('uploads/'.$gambarLama);

                    // hold nama gambar yang akan di-upload di db
                    $model->gambar = $fileGambar->baseName.'.'.$fileGambar->extension;

                    // simpan file di folder 'uploads'
                    $fileGambar->saveAs('uploads/'.$model->gambar);
                    // $fileGambar->saveAs('uploads/'.$fileGambar->baseName.'.'.$fileGambar->extension);
                }   
            } else {
                $model->gambar = $gambarLama;

            }
            
            // $model->save(false);
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Deletes an existing TblPakaian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);

        // menghapus file di direktori uploads
        unlink('uploads/'.$model->gambar);
        
        // menghapus nama file di db
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblPakaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TblPakaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblPakaian::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUpload()
    {
        // $upload = $this->findModel($id);
        $upload = new UploadFiles();

        if (Yii::$app->request->isPost) {
            $upload->holdUploadGambar = UploadedFile::getInstance($upload, 'holdUploadGambar');
            if ($upload->upload()) {
                return $this->redirect(['view', 'id' => $upload->id]);
       
            }
        }
       
        return $this->render('upload', ['model' => $upload]);
    }
}
