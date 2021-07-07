<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-06
 * Time: 14:05
 */

namespace App\ApiPlatform\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Dependency;


final class DependencyDataProvider
    implements ContextAwareCollectionDataProviderInterface,
    ItemDataProviderInterface,
    RestrictedDataProviderInterface
{
    const COMPOSER_FILE_PATH = "/Users/mac/Documents/dev/sofrecom/api/composer.json";

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Dependency::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $depenedencies = [];
        $n = 1;

        foreach ($this->getAllDependencies() as $dep => $version) {
            $dependency = new Dependency($dep, $version);
            $dependency->setId($n);
            $depenedencies[] = $dependency;
        }

        return $depenedencies;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Dependency
    {
        $n = 0;
        foreach ($this->getAllDependencies() as $dep => $version) {
            if ($n == $id - 1) {
                return (new Dependency($dep, $version))->setId($id);
            }
            $n++;
        }
    }

    private function getDependency($id)
    {
        $dependencies = $this->getAll();

        return $dependencies[$id - 1];
    }

    private function getAllDependencies()
    {
        $fileContent = file_get_contents(self::COMPOSER_FILE_PATH);

        return json_decode($fileContent, true)['require'];
    }
}
