<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-04
 * Time: 17:42
 */

namespace App\ApiPlatform\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;

class GeolocalizedFilter  extends AbstractFilter
{
    const PROPERTY_NAME = 'geo';
    protected function filterProperty(string $property, $geo, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        if ($property !== self::PROPERTY_NAME) {
            return;
        }

        $alias = $queryBuilder->getRootAliases()[0];

        $queryBuilder->addSelect(sprintf(
            " ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( %s.latitude ) ) * cos( radians( %s.longitude ) - radians(:longitude) ) + sin( radians(:latitude) ) * sin( radians( %s.latitude ) ) ) ) AS HIDDEN radius",
            $alias,$alias,$alias
        ));
        $queryBuilder->addOrderBy("radius","ASC");
        $queryBuilder->setParameters(
            ['latitude' => $geo['latitude'], 'longitude' => $geo['longitude'], 'radius' => $geo['radius']]
        );
        $queryBuilder->having('(radius < :radius)');
    }

    public function getDescription(string $resourceClass): array
    {
        return [
            self::PROPERTY_NAME."[radius]" => [
                'property' => null,
                'type' => 'float',
                'required' => false,
                'openapi' => [
                    'description' => 'Le rayon de recherche',
                ],
            ],
            self::PROPERTY_NAME."[longitude]" => [
                'property' => null,
                'type' => 'float',
                'required' => false,
                'openapi' => [
                    'description' => 'longitude',
                ],
            ],
            self::PROPERTY_NAME."[latitude]" => [
                'property' => null,
                'type' => 'float',
                'required' => false,
                'openapi' => [
                    'description' => 'latitude',
                ],
            ]
        ];
    }
}
