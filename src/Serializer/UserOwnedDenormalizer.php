<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2021-07-07
 * Time: 07:50
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
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class UserOwnedDenormalizer implements ContextAwareDenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    private $alreadyCalled;

    public function __construct(Security $security)
    {
        $this->security = $security;
        $this->alreadyCalled = uniqid();
    }

    public function supportsDenormalization($data, $type, $format = null, array $context = [])
    {
        $reflectionClass = new \ReflectionClass($type);
        $alreadyCalled = $context[$this->alreadyCalled] ?? false;

        return $reflectionClass->implementsInterface(UserOwnedInterface::class) && !$alreadyCalled;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $context[$this->alreadyCalled] = true;
        $obj = $this->denormalizer->denormalize($data, $type, $format, $context);
        $obj->setUser($this->security->getUser());

        return $obj;

    }

    public function setDenormalizer(DenormalizerInterface $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

}
