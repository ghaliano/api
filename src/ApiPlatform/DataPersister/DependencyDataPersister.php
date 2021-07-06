<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-06
 * Time: 14:40
 */

namespace App\ApiPlatform\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Dependency;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

final class DependencyDataPersister implements ContextAwareDataPersisterInterface
{
    const COMPOSER_FILE_PATH = "/Users/mac/Documents/dev/sofrecom/api/composer.json";

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Dependency;
    }

    public function persist($data, array $context = [])
    {
        $json = json_decode(file_get_contents(self::COMPOSER_FILE_PATH), true);
        if (!$data->getId()){
            $data->setId(uniqid());
        } else if(!isset($json['require'][$data->getName()])) {
            return;
        }

        $json['require'][$data->getName()] = $data->getVersion();
        $fileContent = file_put_contents(self::COMPOSER_FILE_PATH, json_encode($json));

        return $data;
    }

    public function remove($data, array $context = [])
    {
        $json = json_decode(file_get_contents(self::COMPOSER_FILE_PATH), true);
        unset($json['require'][$data->getName()]);
        $fileContent = file_put_contents(self::COMPOSER_FILE_PATH, json_encode($json));
    }
}
