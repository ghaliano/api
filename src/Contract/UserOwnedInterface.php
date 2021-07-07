<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 07:54
 */

namespace App\Contract;


use App\Entity\Place;
use App\Entity\Topic;
use App\Entity\User;

interface UserOwnedInterface
{

    public function getUser(): ?User;

    public function setUser(?User $user);
}
