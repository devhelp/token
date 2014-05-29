<?php

namespace Devhelp\Token\Builder;


use Devhelp\Token\Definition\TokenDefinition;

/**
 * Builds different types of tokens using the definitions
 * stored for each type.
 */
class TokenDirector
{
    protected $defaultDefinition;

    protected $definitions = array();

    protected $builder;

    public function __construct(TokenBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param TokenDefinition $defaultDefinition
     * @return TokenDirector
     */
    public function setDefaultDefinition(TokenDefinition $defaultDefinition)
    {
        $this->defaultDefinition = $defaultDefinition;
        return $this;
    }

    /**
     * @param TokenDefinition $definition
     * @return TokenDirector
     */
    public function addDefinition(TokenDefinition $definition)
    {
        $this->definitions[$definition->getType()] = $definition;
        return $this;
    }

    public function hasDefinition($type)
    {
        return isset($this->definitions[$type]);
    }

    /**
     * @param string $type
     * @return Token|null
     */
    public function build($type)
    {
        if (!$this->hasDefinition($type)) {
            return;
        }

        $definition = $this->definitions[$type];

        if ($this->defaultDefinition) {
            $default = clone $this->defaultDefinition;
            $default->merge($definition);
            $definition = $default;
        }

        return $this->builder->build($definition);
    }
}
