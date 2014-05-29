<?php

namespace Devhelp\Token\Builder;


use Devhelp\Hash\HashGenerator;
use Devhelp\Token\Definition\TokenDefinition;
use Devhelp\Token\Token;

/**
 * Builds Token using TokenDefinition
 */
class TokenBuilder
{

    /**
     * @var HashGenerator
     */
    protected $hashGenerator;

    /**
     * @var \DateTime
     */
    protected $baseDate;

    public function __construct(HashGenerator $hashGenerator)
    {
        $this->hashGenerator = $hashGenerator;
        $this->baseDate = new \DateTime();
    }

    /**
     * @param \DateTime $baseDate
     * @return TokenBuilder
     */
    public function setBaseDate(\DateTime $baseDate)
    {
        $this->baseDate = $baseDate;
        return $this;
    }

    /**
     * @param TokenDefinition $definition
     * @return Token
     */
    public function build(TokenDefinition $definition)
    {
        $token = new Token();
        $token->setType($definition->getType());
        $token->setHash($this->generateHash($definition->getHashAlgorithm()));
        $token->setUsages($definition->getUsages());
        $token->setExpiresAt($this->calculateExpirationDate($definition->getTtl()));

        return $token;
    }

    /**
     * @param string $hashAlgorithm
     * @return string
     */
    protected function generateHash($hashAlgorithm)
    {
        $base = $this->getHashBase();

        return $this->hashGenerator->generate($hashAlgorithm, $base);
    }

    /**
     * @return string
     */
    protected function getHashBase()
    {
        return microtime() . mt_rand();
    }

    /**
     * @param string $ttl
     * @return \DateTime
     */
    protected function calculateExpirationDate($ttl)
    {
        if ($ttl === null) {
            return;
        }

        $expirationDate = clone $this->baseDate;

        $expirationDate->modify($ttl);

        return $expirationDate;
    }
}
