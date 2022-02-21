<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nome
 * @property string $empresa
 * @property string $morada
 * @property int $nif
 * @property int $telefone
 * @property string $email
 * @property int $user_id
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'empresa','morada', 'nif', 'telefone', 'email', 'user_id'], 'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['nif', 'telefone', 'user_id'], 'integer'],
            [['nome', 'empresa','morada', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'empresa' => 'Empresa',
            'morada' => 'Morada',
            'nif' => 'NIF',
            'telefone' => 'Telefone',
            'email' => 'Email',
            'user_id' => 'User ID',
        ];
    }
}
