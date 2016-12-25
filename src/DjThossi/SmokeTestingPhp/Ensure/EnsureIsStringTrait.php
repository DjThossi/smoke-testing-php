<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsStringTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param mixed $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsString($fieldName, $exceptionCode, $valueToTest)
    {
        if (!is_string($valueToTest)) {
            $type = is_object($valueToTest) ? get_class($valueToTest) : gettype($valueToTest);
            $message = sprintf('%s is not a string, got "%s"', $fieldName, $type);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
