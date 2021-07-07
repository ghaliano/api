<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 12:31
 */

namespace App\Serializer;


use ApiPlatform\Core\Exception\RuntimeException;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use App\Entity\Place;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class PlaceApiSerializer implements SerializerContextBuilderInterface
{
    private $security;
    private $decorated;
    public function __construct(Security $security,
     SerializerContextBuilderInterface $decorated)
    {
        $this->security = $security;
        $this->decorated = $decorated;
    }

    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);
        $ressourceClass = $context['resource_class'] ?? null;
        $context['groups'] = isset($context['groups']) && is_array($context['groups'])?$context['groups']:["read:place:collection"];

        if ($ressourceClass === Place::class
            && isset($context['groups'])
            && ($user = $this->security->getUser())){

            $context['groups'][] = "read:user";

            return $context;
        }
    }
}
