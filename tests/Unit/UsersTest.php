<?php

namespace Tests\Unit;

use App\Actions\Users\UserTest;
use App\Models\User;
use Mockery;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class UsersTest extends TestCase
{
    public function test_should_return_user_model_object_if_created_with_success()
    {
        // a
        $userAction = new UserTest();
        $name = "Marriosdev";
        $email = "edmario@outlook.com";

        // a
        $userCreated = $userAction->createUser($name, $email);

        // a
        $this->assertEquals($userCreated->email, $email);
        $this->assertEquals($userCreated->name, $name);
    }

    public function test_should_retur_true_id_user_is_active()
    {
        // a
        $userAction = new UserTest();
        $user = new User();
        $user->active = true;

        // a
        $isActive = $userAction->isUserActive($user);

        // a
        $this->assertTrue($isActive);
    }

    public function test_should_return_true_when_user_is_activated()
    {
        // A
        $userAction = new UserTest();
        $userProperty = (new ReflectionClass($userAction))->getProperty('users');
        $token = "AASSBBDDEE";
        $userProperty->setValue($userAction, [
            new User([
                'name' => 'marriosdev',
                'email' => 'marrios@live.com',
                'active' => false,
                'token' => $token,
            ])
        ]);

        // A
        $activate = $userAction->activateUser($token);

        // A
        $this->assertTrue($activate);
    }

    public function test_should_return_false_if_user_is_not_activated()
    {
        // A
        $userAction = new UserTest();
        $userProperty = (new ReflectionClass($userAction))->getProperty('users');
        $tokenForTest = "AASSBBDDEE";
        $userToken = "IIIUUUUOOO";

        $userProperty->setValue($userAction, [
            new User([
                'name' => 'marriosdev',
                'email' => 'marrios@live.com',
                'active' => false,
                'token' => $userToken,
            ])
        ]);

        // A
        $activate = $userAction->activateUser($tokenForTest);

        // A
        $this->assertFalse($activate);
    }

    public function test_should_return_expected_user_total()
    {
        // A
        $userAction = new UserTest();
        $userAction->createUser('marrios', 'dev@gmail.com');
        $userAction->createUser('marrios', 'dev@gmail.com');
        $userAction->createUser('marrios', 'dev@gmail.com');
        $correctCount = 3;

        // A
        $userCount = $userAction->getTotalUsers();

        // A
        $this->assertEquals($userCount, $correctCount);
    }

    public function test_should_return_incorrect_number_of_users()
    {
        // A
        $userAction = new UserTest();
        $userAction->createUser('marrios', 'dev@gmail.com');
        $userAction->createUser('marrios', 'dev@gmail.com');
        $userAction->createUser('marrios', 'dev@gmail.com');
        $incorrectCount = 2;

        // A
        $userCount = $userAction->getTotalUsers();

        // A
        $this->assertNotEquals($userCount, $incorrectCount);
    }
}
