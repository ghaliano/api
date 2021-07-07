<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 13:53
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;

class PlacePictureController
{
    public function __invoke(Request $request)
    {
        $place = $request->attributes->get('data');
        $files= $request->files->get('file');
    }
}
