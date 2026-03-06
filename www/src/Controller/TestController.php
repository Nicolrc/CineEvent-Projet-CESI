<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\UserEvent;

class TestController extends AbstractController
{
    public function test(){
        $user = new UserEvent();
        $user->setNom('test');
        UserEvent::sqlAdd($user);
        var_dump($user);
        return 'test';
    }
}