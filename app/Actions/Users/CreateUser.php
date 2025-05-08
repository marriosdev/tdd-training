<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Repositories\UserRepository;

class CreateUser
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected UserRepository $userRepository)
    {}

    public function execute(array $data): User
    {
        return $this->userRepository->create($data);
    }
}
