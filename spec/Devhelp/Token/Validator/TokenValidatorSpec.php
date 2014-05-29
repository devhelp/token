<?php

namespace spec\Devhelp\Token\Validator;


use Devhelp\Token\Token;
use PhpSpec\ObjectBehavior;

class TokenValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Devhelp\Token\Validator\TokenValidator');
    }

    function it_adds_one_violation_message_if_token_is_not_usable(Token $token)
    {
        $token->isUsable()->willReturn(false);
        $token->isExpired()->willReturn(false);

        $this->validate($token)->shouldReturnReportWithViolationMessages(array('Token has no usages left'));
    }

    function it_adds_one_violation_message_if_token_expired(Token $token)
    {
        $token->isUsable()->willReturn(true);
        $token->isExpired()->willReturn(true);

        $this->validate($token)->shouldReturnReportWithViolationMessages(array('Token has expired'));
    }

    function it_adds_violation_messages_if_it_not_usable_and_if_token_expired(Token $token)
    {
        $token->isUsable()->willReturn(false);
        $token->isExpired()->willReturn(true);

        $this->validate($token)->shouldReturnReportWithViolationMessages(
            array('Token has no usages left', 'Token has expired')
        );
    }

    public function getMatchers()
    {
        return array(
            'returnReportWithViolationMessages' => function ($subject, $messages) {
                return $subject->getViolations() === $messages;
            }
        );
    }
}
