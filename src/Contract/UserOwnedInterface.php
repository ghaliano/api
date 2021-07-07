<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 10:52
 */

namespace App\Contract;


use App\Entity\User;

interface UserOwnedInterface
{
    public function getUser(): ?User;

    public function setUser(?User $user);
}
