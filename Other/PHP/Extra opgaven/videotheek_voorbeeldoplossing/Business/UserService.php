<?php

declare(strict_types=1);

namespace Business;

use Data\UserDAO;
use Entities\User;

/*
Ofwel zonder namespace/use:

require_once __DIR__ . "/../Data/UserDAO.php";
require_once __DIR__ . "/../Entities/User.php";
*/

class UserService
{
    private UserDAO $userDAO;
    public function __construct()
    {
        $this->userDAO = new UserDAO();
    }

    /**
     * Retrieve user from DB with credentials
     */
    public function loginUser($username, $password): ?User
    {
        return $this->userDAO->loginUser($username, $password);
    }
}
