<?php
namespace frontend\tests;

use common\models\Dadospessoais;
use common\models\User;
use frontend\models\SignupForm;

class UserDadosTest extends \Codeception\Test\Unit
{
    protected $tester;
    protected function _before()
    {
    }
    public function testSomeFeature()
    {
        $user = new User();
        $dados = new Dadospessoais();
        $user->username = 'held';
        $this->assertFalse($user->validate(['username']));
        $user->username = 'helder';
        $this->assertTrue($user->validate(['username']));
        $user->email = 'helder.com';
        $this->assertFalse($user->validate(['email']));
        $user->email = 'helder@email.com';
        $this->assertTrue($user->validate(['email']));
        $user->setPassword(1234567);
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
        $this->assertTrue($user->validate());
        if ($this->assertTrue($user->save())){
            $this->tester->seeRecord('common\models\User',['username' => $user->username,'email' => $user->email]);
            $dados->nomecompleto = 'helder';
            $dados->empresa = 'empresa';
            $dados->pais = 'Portugal';
            $dados->cidade = 'Leiria';
            $dados->morada = 'Leiria';
            $dados->telefone = '123';
            $dados->user_id = $user->id;
            $this->assertEquals($dados->user_id, $user->id);
            $this->assertTrue($dados->validate());
            $this->assertTrue($dados->save());
            $this->tester->seeRecord('common\models\DadosPessoais',['nomecompleto' => $dados->nomecompleto,'user_id' => $user->id]);
        }
    }
}