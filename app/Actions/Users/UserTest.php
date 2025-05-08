<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Str;

class UserTest
{
    protected array $users = [];

    /**
     * Cria um novo usuário com nome e e-mail.
     */
    public function createUser(string $name, string $email): User
    {
        $user = new User([
            'name' => $name,
            'email' => $email,
            'active' => false,
            'token' => Str::random(10),
        ]);

        $this->users[] = $user;

        return $user;
    }

    /**
     * Ativa um usuário com base no token.
     */
    public function activateUser(string $token): bool
    {
        foreach ($this->users as $user) {
            if ($user->token === $token) {
                $user->active = true;
                return true;
            }
        }

        return false;
    }

    /**
     * Verifica se o usuário está ativo.
     */
    public function isUserActive(User $user): bool
    {
        return $user->active;
    }

    /**
     * Retorna o total de usuários cadastrados.
     */
    public function getTotalUsers(): int
    {
        return count($this->users);
    }
}
