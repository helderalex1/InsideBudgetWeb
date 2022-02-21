<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model SignupForm */

use frontend\models\SignupForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;

$this->title = 'Registar';
$this->params['breadcrumbs'][] = $this->title;

$a[] = Yii::$app->authManager->getRoles();

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>

    <div class="row">
            <div class="col-lg-5">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'nomecompleto')->textInput() ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map($roles, 'name', 'description'),['prompt'=>"Selecionar função"]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'confirmarPassword')->passwordInput() ?>
            </div>

            <div class="col-lg-5">
                <?= $form->field($model, 'empresa')->textInput() ?>

                <?= $form->field($model, 'morada')->textInput() ?>

                <?= $form->field($model, 'pais')->widget(\yii\jui\AutoComplete::classname(), [
                    'clientOptions' => [
                        'source' => ["Afeganistão","Estados Unidos da América","Albânia","Argélia","Andorra","Angola","Anguilla","Antígua", "Barbuda","Argentina","Arménia","Austrália","Áustria","Azerbaijão","Bahamas","Bahrein",
                            "Bangladesh","Barbados","Bielorrússia","Bélgica","Belize","Benim", "Bermudas","Bolívia","Bósnia e Herzegovina","Botswana","Brasil","Ilhas Virgens Britânicas","Brunei","Bulgária","Burkina Faso",
                            "Burundi","Camboja","Camarões","Cabo Verde","Ilhas Caimão","Chade","Chile","China","Colômbia","Congo","Ilhas Cook","Costa Rica","Costa Do marfim","Croácia","Navio de Cruzeiro","Cuba","Chipre",
                            "República Checa","Dinamarca","Djibuti","Dominica","República Dominicana","Equador","Egito","El Salvador","Guiné Equatorial", "Estónia","Etiópia","Ilhas Falkland","Ilhas Faroé","Fiji","Finlândia",
                            "França", "Polinésia Francesa", "Índias Ocidentais Francesas", "Gabão","Gâmbia","Geórgia","Alemanha","Gana","Gibraltar","Grécia","Gronelândia","Granada","Guam","Guatemala","Guernsey","Guiné-Bissau",
                            "Guiana","Haiti","Honduras","Hong Kong","Hungria","Islândia","Índia","Indonésia","Irão","Iraque","Irlanda", "Ilha de Man","Israel","Itália","Jamaica","Japão","Jersey","Jordan","Cazaquistão","Quénia",
                            "Kuwait","República do Quirguistão","Laos","Letónia","Líbano","Lesoto","Libéria","Líbia","Liechtenstein","Lituânia","Luxemburgo","Macau","Macedónia","Madagáscar","Malawi","Malásia", "Maldivas", "Mali",
                            "Malta","Mauritânia","Maurícia","México","Moldávia","Mónaco","Mongólia","Montenegro","Montserrat","Marrocos","Moçambique","Namíbia","Nepal","Holanda","Antilhas Holandesas","Nova Caledónia",
                            "Nova Zelândia","Nicarágua","Níger","Nigéria","Noruega","Omã","Paquistão","Palestina","Panamá","Papua Nova Guiné","Paraguai","Peru","Filipinas","Polónia","Portugal","Porto Rico","Qatar","Reunião",
                            "Roménia","Rússia","Ruanda","Saint Pierre", "Miquelon","Samoa","San Marino","Satélite","Arábia Saudita","Senegal","Sérvia","Seychelles","Serra Leoa","Singapura","Eslováquia","Eslovénia",
                            "África do Sul","Coreia do Sul","Espanha","Sri Lanka","St Kitts", "Nevis","St Lucia","St Vincent","St. Lucia","Sudão","Suriname","Suazilândia","Suécia","Suíça","Síria","Taiwan","Tajiquistão",
                            "Tanzânia","Tailândia","Timor L'Este","Togo","Tonga","Trinidad", "Tobago","Tunísia","Turquia","Turquemenistão","Turks", "Caicos","Uganda","Ucrânia","Emirados Árabes Unidos","Reino Unido",
                            "Uruguai","Uzbequistão","Venezuela","Vietname","Ilhas Virgens (EUA)", "Iémen","Zâmbia","Zimbabué"],'minLength'=>'3',
                    ],'options' => ['class' => 'form-control'],
                ]) ?>

                <?= $form->field($model, 'cidade')->textInput() ?>

                <?= $form->field($model, 'telefone')->textInput() ?>


            </div>

        </div>
    </div> <div class="form-group" style="text-align: center">
        <?= Html::submitButton('Registar', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
