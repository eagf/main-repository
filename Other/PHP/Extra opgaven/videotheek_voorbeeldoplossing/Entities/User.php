<?php

declare(strict_types=1);

namespace Entities;

class User
{

    private int $userId; //int(11)
    private string $username; //varchar(255)
    private string $passwordHash; //varchar(255)

    public function __construct(
        int $id,
        string $username,
        string $passwordHash
    ) {
        $this->setUsername($username);
        $this->setPasswordHash($passwordHash);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }
}
