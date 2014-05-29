<?php

namespace spec\Devhelp\Token\Validator;


use PhpSpec\ObjectBehavior;

class ValidationReportSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Devhelp\Token\Validator\ValidationReport');
    }

    function it_is_invalid_if_it_has_violations()
    {
        $this->addViolation('some violation')
             ->isValid()->shouldReturn(false);
    }

    function it_is_valid_if_it_does_not_have_violations()
    {
        $this->isValid()->shouldReturn(true);
    }

    function it_can_store_violation_messages()
    {
        $expectedViolation = 'some violation';

        $this->addViolation($expectedViolation)
             ->addViolation($expectedViolation)
             ->getViolations()
             ->shouldReturn(array($expectedViolation, $expectedViolation));
    }
}
