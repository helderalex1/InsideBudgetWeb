<?php

namespace common\models;

use common\models\Questao;
use common\models\User;
use Yii;

/**
 * This is the model class for table "resposta".
 *
 * @property int $id
 * @property int $questao_id
 * @property int $user_id
 * @property string $texto
 */
class Resposta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resposta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['questao_id', 'user_id', 'texto'], 'required', 'message'=>'O campo {attribute} não pode estar em branco'],
            [['questao_id', 'user_id'], 'integer'],
            [['texto'], 'string', 'max' => 250],
            [['data'], 'safe'],
            [['questao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questao::className(), 'targetAttribute' => ['questao_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'questao_id' => 'questao ID',
            'data' => 'data',
            'user_id' => 'user ID',
            'texto' => 'Texto',
        ];
    }

}
