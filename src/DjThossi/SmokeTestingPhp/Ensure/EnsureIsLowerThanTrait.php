<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsLowerThanTrait
{
    /**
     * @param string $fieldName
     * @param int $maxValue
     * @param int $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsLowerThan($fieldName, $maxValue, $valueToTest, $exceptionCode = 0)
    {
        if ($valueToTest >= $maxValue) {
            $message = sprintf(
                '%s is greater than or equal expected value "%d", got "%d"',
                $fieldName,
                $maxValue,
                $valueToTest
            );
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
