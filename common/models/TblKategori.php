<?php

namespace common\models;

use Yii;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "tbl_kategori".
 *
 * @property int $id
 * @property string $nama_kategori
 */
class TblKategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kategori'], 'required'],
            [['nama_kategori'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_kategori' => 'Nama Kategori',
        ];
    }

    // relasi one to many, sebab 1 kategori dapat memiliki >1 pakaian
    public function getTblPakaians()
    {
        // kolom 'id_kategori' pada tabel pakaian dan 'id' pada tabel kategori
        return $this->hasMany(TblPakaian::className(), ['id_kategori' => 'id']);
    }
}
