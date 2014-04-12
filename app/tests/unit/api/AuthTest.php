<?php
/**
 * @author Smotrov Dmitriy <dsxack@gmail.com>
 */

class AuthTest extends TestCase{
    public function testLogin() {
        $response = ApiControllerBuilder::create()
            ->setControllerClass(AuthController::className())
            ->setActionId("login")
            ->getResponse();

        $this->assertTrue($response['success']);
    }
} 