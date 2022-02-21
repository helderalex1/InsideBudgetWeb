<?php
namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use Yii;

class RegistarCest
{
    public function _before(AcceptanceTester $I)
    {
    }
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('site/signup');
        $I->submitForm('#signup-form',[
            'SignupForm[username]'=>'fornecedor',
            'SignupForm[nomecompleto]'=>'fornecedor',
            'SignupForm[email]'=>'fornecedor@c.c',
            $I->selectOption('SignupForm[role]','fornecedor'),
            'SignupForm[password]'=>'1234567',
            'SignupForm[confirmarPassword]'=>'1234567',
            'SignupForm[empresa]'=>'empresa',
            'SignupForm[morada]'=>'morada',
            'SignupForm[pais]'=>'país',
            'SignupForm[cidade]'=>'cidade',
            'SignupForm[telefone]'=>'telefone'
    ],'signup-button');
        $I->wait(8);
        $I->canSee('Registo concluído depois de confirmar o email terá que aguardar pela aprovação da administração.');
    }
    public function tryConfirmEmail(AcceptanceTester $I)
    {
        $user = $I->grabRecord('common\models\User',['username' => 'a13345aa']);
        $emailLink = '/verify-email?token='. $user->verification_token;
        $I->amOnPage('site'.$emailLink);
        $I->canSee('O seu email foi confirmado com sucesso!');
        $I->wait(2);
        $I->seeRecord('common\models\User', ['status'=> 8]);
        $I->wait(2);
    }
    public function tryLogin(AcceptanceTester $I)
    {
        $I->click('Login', '.nav');
        $I->submitForm('#login-form',[
            'LoginForm[username]'=>'a13345aa',
            'LoginForm[password]'=>'12',
        ],'login-button');
        $I->wait(10);
        $I->cantSee('Logout '.($I->grabRecord('common\models\User', ['username' => 'a13345aa'])->username));
    }
}
