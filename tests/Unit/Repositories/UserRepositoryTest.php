<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function user_is_created_successfully(): void
    {
        $userRepository = app()->make(\App\Repositories\UserRepository::class);

        $userCreated = $userRepository->create([
            'email' => 'edmariooliver@outlook.com',
            'password' => Hash::make('12345678'),
            'name' => 'Marrios Dev'
        ]);

        $userFind = User::find($userCreated->id);
        $this->assertTrue($userCreated->email == $userFind->email);
    }
}
