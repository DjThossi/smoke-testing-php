<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsBooleanTrait
{
    /**
     * @param string $fieldName
     * @param mixed $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsBoolean($fieldName, $valueToTest, $exceptionCode = 0)
    {
        if (!is_bool($valueToTest)) {
            $type = is_object($valueToTest) ? get_class($valueToTest) : gettype($valueToTest);
            $message = sprintf('%s is not a boolean, got "%s"', $fieldName, $type);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
