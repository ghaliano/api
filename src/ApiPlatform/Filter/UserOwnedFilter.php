<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 09:27
 */

namespace App\ApiPlatform\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;



use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class UserOwnedFilter extends AbstractFilter
{
    private $security;

    public function __construct(ManagerRegistry $managerRegistry, ?RequestStack $requestStack = null, LoggerInterface $logger = null, array $properties = null, NameConverterInterface $nameConverter = null, Security $security)
    {
        parent::__construct( $managerRegistry, $requestStack , $logger ,$properties, $nameConverter);
        $this->security = $security;
    }

    protected function filterProperty(string $property, $geo, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {    }

    public function getDescription(string $resourceClass): array
    {
        return [];
    }
}
