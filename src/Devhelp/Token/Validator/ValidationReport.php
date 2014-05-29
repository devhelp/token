<?php

namespace Devhelp\Token\Validator;


class ValidationReport
{
    private $violations = array();

    /**
     * @param string $message
     * @return ValidationReport
     */
    public function addViolation($message)
    {
        $this->violations[] = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->violations ? false : true;
    }
}
