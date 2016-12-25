<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsLowerThanTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param int $maxValue
     * @param int $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsLowerThan($fieldName, $exceptionCode, $maxValue, $valueToTest)
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
