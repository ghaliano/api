<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-05
 * Time: 16:37
 */

namespace App\Controller;


use App\Entity\Place;

class PublishController
{
    public function __invoke(Place $data):Place
    {
        $data->setIsEnabled(true);

        return $data;
    }
}
