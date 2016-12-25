<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsNotEmptyTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param mixed $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsNotEmpty($fieldName, $exceptionCode, $valueToTest)
    {
        if (empty($valueToTest)) {
            $message = sprintf('%s should not be empty', $fieldName);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
