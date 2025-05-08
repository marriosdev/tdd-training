<?php

namespace Tests\Unit\Actions\Users;

use App\Actions\Users\CreateUser;
use App\Models\User;
use App\Repositories\UserRepository;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    public function test_user_is_created_successfully(): void
    {
        $mockRepository = $this->createMock(UserRepository::class);

        $inputData = [
            'name' => 'João da Silva',
            'email' => 'joao@example.com',
            'password' => 'secret'
        ];

        $expectedUser = new User($inputData);

        $mockRepository->expects($this->once())
            ->method('create')
            ->with($inputData)
            ->willReturn($expectedUser);

        $action = new CreateUser($mockRepository);
        $result = $action->execute($inputData);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($expectedUser->name, $result->name);
        $this->assertEquals($expectedUser->email, $result->email);
    }
}
