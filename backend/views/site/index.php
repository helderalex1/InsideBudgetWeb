<?php

/* @var $this yii\web\View */

use common\models\AuthAssignment;
use common\models\User;

$this->title = 'Informações Admin';
?>
<div class="site-index">

    <table>

        <tr>
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de utilizadores <?= count(User::find()->all())?> </p>
                </div>
            </th>
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de utilizadores com acesso <?= count(User::find()->where(['status' => 10])->all()) ?></p>
                </div>
            </th>
        </tr>
        <tr >
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de utilizadores à espera de acesso <?= count(User::find()->where(['status' => 9])->all()) ?></p>
                </div>
            </th>
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de utilizadores sem email confirmado <?= count(User::find()->where(['status' => 8])->all()) ?></p>
                </div>
            </th>
        </tr>
        <tr >
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de utilizadores bloqueados <?= count(User::find()->where(['status' => 0])->all()) ?></p>
                </div>
            </th>
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de Instaladores com acesso <?php $quantInstalador = 0;foreach(User::find()->where(['status' => 10])->all() as $instalador){
                        if(AuthAssignment::findOne(['user_id' => $instalador['id']])->item_name == "instalador"){
                            $quantInstalador++;
                        }

                        }echo $quantInstalador; ?></p>
                </div>
            </th>
        </tr>
        <tr >
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de Fornecedores com acesso <?php $quantIFornecedor = 0;foreach(User::find()->where(['status' => 10])->all() as $fornecedor){
                            if(AuthAssignment::findOne(['user_id' => $fornecedor['id']])->item_name == 'fornecedor'){
                                $quantIFornecedor++;
                            }

                        }echo $quantIFornecedor; ?></p>
                </div>
            </th>
            <th style="text-align: center">
                <div class="col-lg-12">
                    <p>Total de Admins com acesso <?php $quantAdmin = 0;foreach(User::find()->where(['status' => 10])->all() as $admin){
                        if(AuthAssignment::findOne(['user_id' => $admin['id']])->item_name == 'admin'){
                            $quantAdmin++;
                        }

                        }echo $quantAdmin; ?></p>
                </div>
            </th>
        </tr>

    </table>
</div>
