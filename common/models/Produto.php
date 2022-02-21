<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string $nome
 * @property string $referencia
 * @property string $descricao
 * @property float $preco
 * @property int $fornecedor_id
 * @property int $tipologia_id
 *
 * @property User $fornecedor
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'referencia', 'descricao', 'preco', 'fornecedor_id', 'tipologia_id'], 'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['preco'], 'number'],
            [['fornecedor_id', 'tipologia_id'], 'integer'],
            ['tipologia_id','compare','compareValue'=>'1','operator'=>'>','message'=>"Tipo de produto inválido"],
            [['nome', 'referencia', 'descricao'], 'string', 'max' => 255],
            [['fornecedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fornecedor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
        public function required($attribute){
                if($attribute != null){
                $this->addError("djsbs");}

        }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'referencia' => 'Referência',
            'descricao' => 'Descrição',
            'preco' => 'Preço',
            'fornecedor_id' => 'Fornecedor ID',
            'tipologia_id' => 'Tipologia ID',
        ];
    }

    /**
     * Gets query for [[Fornecedor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFornecedor()
    {
        return $this->hasOne(User::className(), ['id' => 'fornecedor_id']);
    }
}
