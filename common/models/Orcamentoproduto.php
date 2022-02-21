<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orcamento_produto".
 *
 * @property int $id
 * @property int $orcamento_id
 * @property int $produto_id
 * @property int $quantidade
 */
class Orcamentoproduto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orcamento_produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orcamento_id', 'produto_id', 'quantidade'], 'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['orcamento_id', 'produto_id', 'quantidade'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orcamento_id' => 'Orcamento ID',
            'produto_id' => 'Produto ID',
            'quantidade' => 'Quantidade',
        ];
    }
    public function getOrcamento()
    {
        return $this->hasOne(Orcamento::className(), ['id' => 'orcamento_id']);
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_id']);
    }
}
