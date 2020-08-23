<?php

namespace VNPCMS\User\Repository;


use VNPCMS\User\UserRegistrationDTO;

interface UserRepositoryInterface {
    public function saveUser(UserRegistrationDTO $user);
} 