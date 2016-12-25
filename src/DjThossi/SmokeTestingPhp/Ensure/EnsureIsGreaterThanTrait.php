<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsGreaterThanTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param int $minValue
     * @param int $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsGreaterThan($fieldName, $exceptionCode, $minValue, $valueToTest)
    {
        if ($valueToTest <= $minValue) {
            $message = sprintf(
                '%s is lower than or equal  expected value "%d", got "%d"',
                $fieldName,
                $minValue, $valueToTest
            );
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
