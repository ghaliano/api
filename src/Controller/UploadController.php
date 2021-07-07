<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 14:22
 */

namespace App\Controller;

use App\Contract\UploadApiInterface;
use Symfony\Component\HttpFoundation\Request;

class UploadController
{
    public function __invoke(Request $request)
    {
        $entity = $request->attributes->get('data');
        $file = $request->files->all();
        $reflection = new \ReflectionClass($entity);

        if (!$reflection->implementsInterface(UploadApiInterface::class)){
            return $entity;
        }

        $entity->setPictureFile($file["file"]);

        return $entity;
    }
}
