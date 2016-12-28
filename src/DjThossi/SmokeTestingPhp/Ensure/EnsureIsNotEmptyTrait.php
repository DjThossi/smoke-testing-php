<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsNotEmptyTrait
{
    /**
     * @param string $fieldName
     * @param mixed $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsNotEmpty($fieldName, $valueToTest, $exceptionCode = 0)
    {
        if (empty($valueToTest)) {
            $message = sprintf('%s should not be empty', $fieldName);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
