<?php
namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;
class QuestaoCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('site/login');
        $I->submitForm('#login-form', [
            'LoginForm[username]'=>'a13345aa',
            'LoginForm[password]'=>'12',
        ],'login-button');
        $I->see("a13345aa");
    }

    public function tryCriarQuestao(FunctionalTester $I)
    {
        $I->amOnPage('questao/create');
        $I->see("Criar Dúvidas e questões");
        $I->selectOption('Questao[assunto_id]',1);
        $I->click('Criar questão');
        $I->dontSeeValidationError('O campo Mensagem não pode estar em branco');
        $I->canSeeRecord("common\models\questao",['email' => 'helder@email.com']);
        $I->see('Questão enviada com sucesso');
        $I->fillField('Resposta[texto]', 'resposta');
        $I->click('Enviar');
        $I->dontSeeValidationError('O campo Texto não pode estar em branco');
    }
}
