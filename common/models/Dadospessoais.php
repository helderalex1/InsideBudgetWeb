<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dadospessoais".
 *
 * @property int $id
 * @property string $nomecompleto
 * @property string $empresa
 * @property string $pais
 * @property string $cidade
 * @property string $morada
 * @property int $telefone
 * @property int $user_id
 */
class Dadospessoais extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dadospessoais';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomecompleto', 'empresa', 'pais', 'cidade', 'morada', 'telefone', 'user_id'], 'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['telefone', 'user_id'], 'integer'],
            [['nomecompleto', 'empresa', 'pais', 'cidade', 'morada'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nomecompleto' => 'Nome Completo',
            'empresa' => 'Empresa',
            'pais' => 'País',
            'cidade' => 'Cidade',
            'morada' => 'Morada',
            'telefone' => 'Telefone',
            'user_id' => 'User ID',
        ];
    }
}
