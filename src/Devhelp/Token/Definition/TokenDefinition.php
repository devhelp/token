<?php

namespace Devhelp\Token\Definition;


class TokenDefinition
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var integer
     */
    protected $usages;

    /**
     * @var string
     */
    protected $ttl;

    /**
     * @var string
     */
    protected $hashAlgorithm;

    /**
     * @param string $type
     * @return TokenDefinition
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $class
     * @return TokenDefinition
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $hashAlgorithm
     * @return TokenDefinition
     */
    public function setHashAlgorithm($hashAlgorithm)
    {
        $this->hashAlgorithm = $hashAlgorithm;
        return $this;
    }

    /**
     * @return string
     */
    public function getHashAlgorithm()
    {
        return $this->hashAlgorithm;
    }

    /**
     * @param string $ttl
     * @return TokenDefinition
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        return $this;
    }

    /**
     * @return string
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $usages
     * @return TokenDefinition
     */
    public function setUsages($usages)
    {
        $this->usages = $usages;
        return $this;
    }

    /**
     * @return int
     */
    public function getUsages()
    {
        return $this->usages;
    }

    /**
     * @param TokenDefinition $definition
     * @return $this
     */
    public function merge(TokenDefinition $definition)
    {
        if ($definition->getClass() && $this->class === null) {
            $this->class = $definition->getClass();
        }

        if ($definition->getHashAlgorithm() && $this->hashAlgorithm === null) {
            $this->hashAlgorithm = $definition->getHashAlgorithm();
        }

        if ($definition->getTtl() && $this->ttl === null) {
            $this->ttl = $definition->getTtl();
        }

        if ($definition->getUsages() !== null && $this->usages === null) {
            $this->usages = $definition->getUsages();
        }

        return $this;
    }
}
