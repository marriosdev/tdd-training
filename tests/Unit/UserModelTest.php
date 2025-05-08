<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_return_true_if_user_created()
    {
        $userCreated = User::create([
            'email' => 'edmariooliver@outlook.com',
            'password' => Hash::make('12345678'),
            'name' => 'Marrios Dev'
        ]);

        $userFind = User::find($userCreated->id);

        $this->assertTrue($userCreated->email == $userFind->email);
    }
}
