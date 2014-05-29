<?php

namespace Devhelp\Token\Validator;


use Devhelp\Token\Token;

class TokenValidator
{
    public function validate(Token $token)
    {
        $report = new ValidationReport();

        !$token->isUsable() && $report->addViolation('Token has no usages left');
        $token->isExpired() && $report->addViolation('Token has expired');

        return $report;
    }
}
