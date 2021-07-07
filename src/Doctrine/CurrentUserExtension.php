<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 10:41
 */

namespace App\Doctrine;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Contract\UserOwnedInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    private $security;
    private $authorization;

    public function __construct(Security $security, AuthorizationCheckerInterface $authorization)
    {
        $this->security = $security;
        $this->authorization = $authorization;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->whereUser($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->whereUser($queryBuilder, $resourceClass);
    }

    private function whereUser(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $reflection = new \ReflectionClass($resourceClass);

        if ($reflection->implementsInterface(UserOwnedInterface::class)) {
            $alias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere("$alias.user=:current_user");
            $queryBuilder->setParameter('current_user', $this->security->getUser()->getId());
        }
    }
}
