<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 14:22
 */

namespace App\Controller;


use App\Entity\Place;
use Symfony\Component\HttpFoundation\Request;

class PlacePictureUpload
{
    public function __invoke(Request $request)
    {
        $place = $request->attributes->get('data');

        if ($place instanceof Place){
            $file = $request->files->get('file');
            $place->setPictureFile($file);
        }
    }
}
