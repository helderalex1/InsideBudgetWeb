<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "questao".
 *
 * @property int $id
 * @property int $assunto_id
 * @property string|null $mensagem
 * @property string|null $email
 * @property int|null $lida
 * @property string|null $data
 * @property int $user_id
 */
class Questao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['assunto_id', 'user_id', 'email'], 'required'],
            [['assunto_id', 'respondida', 'concluida','user_id'], 'integer'],
            [['data'], 'safe'],
            [['mensagem'],'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['mensagem', 'email'], 'string', 'max' => 255],
            [['assunto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Assunto::className(), 'targetAttribute' => ['assunto_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['email'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['email' => 'email']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assunto_id' => 'Assunto',
            'mensagem' => 'Mensagem',
            'email' => 'Email',
            'respondida' => 'respondida',
            'concluida' => 'concluida',
            'data' => 'Data',
            'user_id' => 'Utilizador'
        ];
    }


}
