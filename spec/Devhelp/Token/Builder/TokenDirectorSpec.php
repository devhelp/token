<?php

namespace spec\Devhelp\Token\Builder;


use Devhelp\Token\Builder\TokenBuilder;
use Devhelp\Token\Definition\TokenDefinition;
use Devhelp\Token\Token;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument as a;

class TokenDirectorSpec extends ObjectBehavior
{

    function let(TokenBuilder $builder)
    {
        $this->beConstructedWith($builder);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Devhelp\Token\Builder\TokenDirector');
    }

    function it_can_be_set_with_default_TokenDefinition(TokenDefinition $definition)
    {
        $this->setDefaultDefinition($definition)->shouldReturn($this);
    }

    function it_returns_false_if_TokenDefinition_does_not_exist()
    {
        $this->hasDefinition('type')->shouldReturn(false);
    }

    function it_returns_true_if_TokenDefinition_was_added(TokenDefinition $definition)
    {
        $type = 'type';

        $definition->getType()->willReturn($type);

        $this->after()->addDefinition($definition)->hasDefinition($type)->shouldReturn(true);
    }

    function it_returns_null_on_build_when_TokenDefinition_does_not_exist()
    {
        $this->build('type')->shouldReturn(null);
    }

    function it_returns_Token_on_build_if_TokenDefinition_exists(
        TokenBuilder $builder,
        TokenDefinition $definition,
        Token $token
    ) {
        $type = 'type';

        $definition->getType()->willReturn($type);

        $builder->build($definition)->willReturn($token);

        $this->beConstructedWith($builder);

        $this->after()->addDefinition($definition)->build($type)->shouldReturn($token);
    }

    function it_uses_merged_definition_if_default_definition_exists_to_build_Token(
        TokenDefinition $defaultDefinition,
        TokenDefinition $definition,
        TokenDefinition $mergedDefinition,
        Token $token,
        TokenBuilder $builder
    ) {
        $type = 'type';

        $defaultDefinition->merge($definition)->willReturn($mergedDefinition);

        $definition->getType()->willReturn($type);

        /**
         * $definition is created based on CLONED version of original, so it is not possible to
         * check if object passed as an argument is exactly the same. It is possible to checks
         * that it is not the usual one ($definition)
         */
        $builder->build(a::not($definition))->willReturn($token);

        $this->beConstructedWith($builder);

        $this->setDefaultDefinition($defaultDefinition)->addDefinition($definition)->build($type);
    }

    function after()
    {
        return $this;
    }
}
