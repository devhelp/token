<?php

namespace Devhelp\Token;


class Token
{

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     */
    protected $usages;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * @var mixed
     */
    protected $resource;

    /**
     * @param string $type
     * @return Token
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
     * @param \DateTime $expiresAt
     * @return Token
     */
    public function setExpiresAt(\DateTime $expiresAt = null)
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param string $hash
     * @return Token
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $resource
     * @return Token
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param int $usages
     * @return Token
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

    public function isExpired()
    {
        return ($this->expiresAt instanceof \DateTime) && ($this->expiresAt < new \DateTime());
    }

    public function isUsable()
    {
        return is_null($this->usages) || $this->usages;
    }

    /**
     * @return Token
     */
    public function decrementUsages()
    {
        if ($this->isUsable() && $this->usages) {
            $this->usages--;
        }

        return $this;
    }
}
