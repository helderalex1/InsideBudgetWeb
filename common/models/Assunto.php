<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "assunto".
 *
 * @property int $id
 * @property int|null $assunto
 */
class Assunto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assunto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assunto'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assunto' => 'Assunto',
        ];
    }

    public static function getNome($id)
    {
        $assunto = Assunto::find()->where(['id'=>$id])->asArray()->all();
        return $assunto[0]['assunto'];
    }


}
