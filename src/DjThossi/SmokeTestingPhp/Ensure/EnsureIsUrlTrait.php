<?php
namespace DjThossi\SmokeTestingPhp\Ensure;

trait EnsureIsUrlTrait
{
    /**
     * @param string $fieldName
     * @param mixed $valueToTest
     * @param int $exceptionCode
     *
     * @throws InvalidValueException
     */
    protected function ensureIsUrl($fieldName, $valueToTest, $exceptionCode = 0)
    {
        $regex = '@^(https?|ftp)://[^\s/$.?#].[^\s]*$@iS';

        if (preg_match($regex, $valueToTest) !== 1) {
            $message = sprintf('%s is not a matching url, got "%s"', $fieldName, $valueToTest);
            throw new InvalidValueException($message, $exceptionCode);
        }
    }
}
