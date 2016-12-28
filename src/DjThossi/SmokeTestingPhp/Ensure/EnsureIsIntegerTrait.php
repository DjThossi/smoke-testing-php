<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsIntegerTrait
{
    /**
     * @param string $fieldName
     * @param mixed $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsInteger($fieldName, $valueToTest, $exceptionCode = 0)
    {
        if (!is_int($valueToTest)) {
            $type = is_object($valueToTest) ? get_class($valueToTest) : gettype($valueToTest);
            $message = sprintf('%s is not an integer, got "%s"', $fieldName, $type);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
