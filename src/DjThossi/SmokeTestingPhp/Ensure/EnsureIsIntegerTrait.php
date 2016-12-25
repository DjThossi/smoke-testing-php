<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsIntegerTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param mixed $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsInteger($fieldName, $exceptionCode, $valueToTest)
    {
        if (!is_integer($valueToTest)) {
            $type = is_object($valueToTest) ? get_class($valueToTest) : gettype($valueToTest);
            $message = sprintf('%s is not an integer, got "%s"', $fieldName, $type);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
