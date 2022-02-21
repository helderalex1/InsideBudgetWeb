<?php
namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
class ProdutoCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->submitForm('#login-form',[
            'LoginForm[username]'=>'fornecedor',
            'LoginForm[password]'=>'1234567',
        ],'login-button');
        $I->wait(2);
        $I->click('Produtos', '.nav');
        $I->click('Criar Produto');
        $I->wait(2);
        $I->submitForm('#produto-form',[
            'Produto[nome]'=>'fornecedor',
            'Produto[referencia]'=>'1234567',
            'Produto[descricao]'=>'1234567',
            'Produto[preco]'=>'1234567',
            $I->selectOption('Produto[tipologia_id]','Eletrônica')
        ],'produto-button');
        $I->wait(2);
        $I->canSee('Produto fornecedor');
        $I->wait(2);
    }
}
