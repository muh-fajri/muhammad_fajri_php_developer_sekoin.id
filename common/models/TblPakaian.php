<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "tbl_pakaian".
 *
 * @property int $id
 * @property string $nama_pakaian
 * @property int $id_kategori
 * @property string|null $gambar
 * @property string|null $deskripsi
 * @property int|null $harga
 */
class TblPakaian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_pakaian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pakaian', 'id_kategori'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            [['id_kategori', 'harga'], 'integer'],
            [['nama_pakaian', 'gambar'], 'string', 'max' => 128],
            [['deskripsi'], 'string', 'max' => 255],
            // [['id_kategori'], 'unique'],
            [['gambar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg'],
            // [['gambar'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_pakaian' => 'Nama Pakaian',
            'id_kategori' => 'Nama Kategori',
            'gambar' => 'Gambar',
            'deskripsi' => 'Deskripsi',
            'harga' => 'Harga',
        ];
    }

    // relasi one to one, sebab 1 pakaian hanya memiliki 1 kategori
    public function getTblKategori()
    {
        // kolom 'id' pada tabel kategori dan 'id_kategori' pada tabel pakaian
        return $this->hasOne(TblKategori::className(), ['id' => 'id_kategori']);
    }


    // fungsi untuk mengambil URL gambar, ditampilkan pada view
    public function getUrlGambar() {
        return \Yii::$app->request->baseUrl.'/uploads/'.$this->gambar;
    }

    // fungsi untuk mendapatkan nama kategori
}
