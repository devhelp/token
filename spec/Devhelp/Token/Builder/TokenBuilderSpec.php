<?php

namespace spec\Devhelp\Token\Builder;


use Devhelp\Hash\HashGenerator;
use Devhelp\Token\Definition\TokenDefinition;
use Devhelp\Token\Token;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument as a;

class TokenBuilderSpec extends ObjectBehavior
{

    private $hash = 'test_hash';

    function let(HashGenerator $hashGenerator)
    {
        $hashGenerator->generate(a::any(), a::any())->willReturn($this->hash);

        $this->beConstructedWith($hashGenerator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Devhelp\Token\Builder\TokenBuilder');
    }

    function it_builds_token_according_to_given_TokenDefinition(TokenDefinition $definition)
    {
        $baseDate = new \DateTime('2000-01-01');
        $type = 'test';
        $expiresAt = new \DateTime('2000-01-04');
        $usages = 0;

        $definition->getClass()->willReturn('Devhelp\Token\Token');
        $definition->getType()->willReturn($type);
        $definition->getTtl()->willReturn('3 days');
        $definition->getUsages()->willReturn($usages);
        $definition->getHashAlgorithm()->willReturn('test_alg');

        $this->setBaseDate($baseDate)
             ->build($definition)
             ->shouldReturnTokenWith($type, $expiresAt, $usages, $this->hash);
    }

    function it_throws_an_exception_if_token_class_is_not_an_instance_of_DevhelpTokenToken(TokenDefinition $definition)
    {
        $definition->getClass()->willReturn('\stdClass');

        $this->shouldThrow('\InvalidArgumentException')->duringBuild($definition);
    }

    public function getMatchers()
    {
        return array(
            'returnTokenWith' => function ($subject, $type, $expiresAt, $usages, $hash) {
                return $subject instanceof Token &&
                       $subject->getType() === $type &&
                       $subject->getExpiresAt() == $expiresAt &&
                       $subject->getUsages() === $usages &&
                       $subject->getHash() === $hash;
            }
        );
    }
}
