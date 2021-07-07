<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 10:52
 */

namespace App\Contract;
use Symfony\Component\HttpFoundation\File\File;

use App\Entity\User;

interface UploadApiInterface
{
    public function setPictureFile(File $picture = null);
}
