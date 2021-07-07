<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 04:34
 */

namespace App\Doctrine;


use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Place;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;

class CurrentUserExtension implements QueryCollectionExtensionInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        //echo $operationName;
        if ($resourceClass !== Place::class){
            return;
        }

        if ($user = $this->security->getUser()) {
            $alias = $queryBuilder->getRootAliases()[0];
            $queryBuilder
                ->andWhere("$alias.user=:current_user")
                ->setParameter("current_user", $this->security->getUser()->getId());
        }
    }

}
