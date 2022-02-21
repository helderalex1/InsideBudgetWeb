<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orcamento".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property float $total
 * @property string|null $data
 * @property string $uid
 * @property int $cliente_id
 * @property int $user_id
 *
 * @property Cliente $cliente
 * @property OrcamentoProduto[] $orcamentoProdutos
 */
class Orcamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orcamento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao', 'uid', 'cliente_id', 'user_id'], 'required','message'=>'O campo {attribute} não pode estar em branco'],
            [['total'], 'number'],
            [['data'], 'safe'],
            [['cliente_id', 'user_id'], 'integer'],
            [['nome', 'descricao', 'uid'], 'string', 'max' => 255],
            [['uid'], 'unique'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente_id' => 'id']],
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
            'descricao' => 'Descrição',
            'total' => 'Total',
            'data' => 'Data',
            'uid' => 'uid',
            'cliente_id' => 'Cliente ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[OrcamentoProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrcamentoProdutos()
    {
        return $this->hasMany(OrcamentoProduto::className(), ['orcamento_id' => 'id']);
    }
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['id' => 'produto_id'])->viaTable('orcamento_produto', ['orcamento_id' => 'id']);
    }

    public function getProdutosQuantidade()
    {
        $produtos = $this->getProdutos();

        $produtos = $produtos->asArray()->all();
        $i=0;
        foreach ( $produtos as $produto) {
            $array= OrcamentoProduto::find()->where(['orcamento_id' => $this['id'], 'produto_id' => $produto['id']])->select(['quantidade'])->asArray()->all();
            $produtos[$i]["quantidade"] = $array[0]['quantidade'];
            $i++;
        }
        return $produtos;
    }
}
