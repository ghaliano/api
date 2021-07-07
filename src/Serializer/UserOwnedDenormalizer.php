<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 11:52
 */

namespace App\Serializer;


use App\Contract\UserOwnedInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UserOwnedDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface
{
    private $denormalizer;
    private $security;
    private $alreadyCalled;

    public function __construct(Security $security)
    {
        $this->security = $security;
        $this->alreadyCalled = "UserOwnedDenormalizer".uniqid();
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = [])
    {
        $reflection = new \ReflectionClass($type);

        return $reflection->implementsInterface(UserOwnedInterface::class)
            && !isset($context[$this->alreadyCalled]);
    }

    public function setDenormalizer(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $context[$this->alreadyCalled] = true;
        $obj = $this->denormalizer->denormalize($data, $type, $format, $context);
        $obj->setUser($this->security->getUser());

        return $obj;
    }

}
