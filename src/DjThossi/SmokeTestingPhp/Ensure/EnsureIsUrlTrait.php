<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsUrlTrait
{
    /**
     * @param string $fieldName
     * @param int $exceptionCode
     * @param mixed $valueToTest
     *
     * @throws InvalidValueException
     */
    protected function ensureIsUrl($fieldName, $exceptionCode, $valueToTest)
    {
        $regex = '@^(https?|ftp)://[^\s/$.?#].[^\s]*$@iS';

        if (preg_match($regex, $valueToTest) !== 1) {
            $message = sprintf('%s is not a matching url, got "%s"', $fieldName, $valueToTest);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
