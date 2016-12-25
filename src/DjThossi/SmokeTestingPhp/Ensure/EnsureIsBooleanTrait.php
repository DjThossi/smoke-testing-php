<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsBooleanTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param mixed $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsBoolean($fieldName, $exceptionCode, $valueToTest)
    {
        if (!is_bool($valueToTest)) {
            $type = is_object($valueToTest) ? get_class($valueToTest) : gettype($valueToTest);
            $message = sprintf('%s is not a boolean, got "%s"', $fieldName, $type);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
