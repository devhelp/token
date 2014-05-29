<?php

namespace spec\Devhelp\Token;


use PhpSpec\ObjectBehavior;

class TokenSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Devhelp\Token\Token');
    }

    function it_is_usable_if_usages_was_not_set()
    {
        $this->isUsable()->shouldReturn(true);
    }

    function it_is_usable_if_usages_is_greater_than_zero()
    {
        $this->after()->setUsages(4)->isUsable()->shouldReturn(true);
    }

    function it_is_not_usable_if_usages_equals_zero()
    {
        $this->after()->setUsages(0)->isUsable()->shouldReturn(false);
    }

    function it_is_expired_if_expiration_date_passed()
    {
        $this->after()->setExpiresAt(new \DateTime('-1 day'))->isExpired()->shouldReturn(true);
    }

    function it_is_not_expired_if_there_is_no_expiration_date()
    {
        $this->isExpired()->shouldReturn(false);
    }

    function it_is_not_expired_if_expiration_date_did_not_pass()
    {
        $this->after()->setExpiresAt(new \DateTime('+1 day'))->isExpired()->shouldReturn(false);
    }

    function it_decrements_usages_if_token_is_usable_and_has_usages()
    {
        $this->after()->setUsages(1)->decrementUsages()->getUsages()->shouldReturn(0);
    }

    function it_does_not_decrement_usages_if_token_is_not_usable()
    {
        $this->after()->decrementUsages()->getUsages()->shouldReturn(null);
    }

    function it_does_not_decrement_usages_if_token_has_zero_usages()
    {
        $this->after()->setUsages(0)->decrementUsages()->getUsages()->shouldReturn(0);
    }

    function after()
    {
        return $this;
    }
}
