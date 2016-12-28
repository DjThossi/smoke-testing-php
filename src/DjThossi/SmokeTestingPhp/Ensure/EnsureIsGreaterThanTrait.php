<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsGreaterThanTrait
{
    /**
     * @param string $fieldName
     * @param int $minValue
     * @param int $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsGreaterThan($fieldName, $minValue, $valueToTest, $exceptionCode = 0)
    {
        if ($valueToTest <= $minValue) {
            $message = sprintf(
                '%s is lower than or equal expected value "%d", got "%d"',
                $fieldName,
                $minValue,
                $valueToTest
            );
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
