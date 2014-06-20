<?php

namespace spec\Devhelp\Token\Definition;


use Devhelp\Token\Definition\TokenDefinition;
use PhpSpec\ObjectBehavior;

class TokenDefinitionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Devhelp\Token\Definition\TokenDefinition');
    }

    function it_merges_token_definition(TokenDefinition $definition)
    {
        $definition->getClass()->willReturn('My\Class');
        $definition->getHashAlgorithm()->willReturn('test_alg');
        $definition->getUsages()->willReturn(0);
        $definition->getTtl()->willReturn('1 day');

        $token = $this->merge($definition);

        $token->getClass()->shouldReturn('My\Class');
        $token->getHashAlgorithm()->shouldReturn('test_alg');
        $token->getUsages()->shouldReturn(0);
        $token->getTtl()->shouldReturn('1 day');
    }

    function it_does_not_merge_token_definition_if_values_were_already_set(TokenDefinition $definition)
    {
        $class = 'My\Class';
        $hashAlgorithm = 'my_alg';
        $usages = 3;
        $ttl = '3 days';

        $this->setClass($class);
        $this->setHashAlgorithm($hashAlgorithm);
        $this->setUsages($usages);
        $this->setTtl($ttl);

        $definition->getClass()->willReturn('My\Class2');
        $definition->getHashAlgorithm()->willReturn('test_alg');
        $definition->getUsages()->willReturn(0);
        $definition->getTtl()->willReturn('1 day');

        $token = $this->merge($definition);

        $token->getClass()->shouldReturn($class);
        $token->getHashAlgorithm()->shouldReturn($hashAlgorithm);
        $token->getUsages()->shouldReturn($usages);
        $token->getTtl()->shouldReturn($ttl);
    }
}
