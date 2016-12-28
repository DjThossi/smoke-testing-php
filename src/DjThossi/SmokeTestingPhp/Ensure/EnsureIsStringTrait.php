<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsStringTrait
{
    /**
     * @param string $fieldName
     * @param mixed $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsString($fieldName, $valueToTest, $exceptionCode = 0)
    {
        if (!is_string($valueToTest)) {
            $type = is_object($valueToTest) ? get_class($valueToTest) : gettype($valueToTest);
            $message = sprintf('%s is not a string, got "%s"', $fieldName, $type);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
