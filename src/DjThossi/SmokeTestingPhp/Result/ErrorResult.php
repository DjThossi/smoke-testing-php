<?php
namespace DjThossi\SmokeTestingPhp\Result;

use DjThossi\SmokeTestingPhp\Collection\HeaderCollection;
use DjThossi\SmokeTestingPhp\ValueObject\ErrorMessage;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

class ErrorResult implements Result
{
    /**
     * @var Url
     */
    private $url;

    /**
     * @var HeaderCollection
     */
    private $headers;

    /**
     * @var ErrorMessage
     */
    private $errorMessage;

    /**
     * @param Url $url
     * @param HeaderCollection $headers
     * @param ErrorMessage $errorMessage
     */
    public function __construct(Url $url, HeaderCollection $headers, ErrorMessage $errorMessage)
    {
        $this->url = $url;
        $this->headers = $headers;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @param string $url
     * @param array $headerData
     * @param $errorMessage
     *
     * @return ErrorResult
     */
    public static function fromPrimitives(
        $url,
        array $headerData,
        $errorMessage
    ) {
        return new self(
            new Url($url),
            HeaderCollection::fromArray($headerData),
            new ErrorMessage($errorMessage)
        );
    }

    /**
     * @return string
     */
    public function asString()
    {
        return $this->errorMessage->asString();
    }

    /**
     * @return HeaderCollection
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function isValidResult()
    {
        return false;
    }

    public function getTimeToFirstByte()
    {
        throw new NotImplementedException('getTimeToFirstByte is not implemented');
    }

    public function getBody()
    {
        throw new NotImplementedException('getBody is not implemented');
    }

    public function getStatusCode()
    {
        throw new NotImplementedException('getStatusCode is not implemented');
    }
}
