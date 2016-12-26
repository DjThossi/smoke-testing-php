<?php
namespace DjThossi\SmokeTestingPhp;

use Curl\Curl;
use Curl\MultiCurl;
use DjThossi\SmokeTestingPhp\Collection\ResultCollection;
use DjThossi\SmokeTestingPhp\Result\ErrorResult;
use DjThossi\SmokeTestingPhp\Result\ValidResult;
use DjThossi\SmokeTestingPhp\ValueObject\Body;
use DjThossi\SmokeTestingPhp\ValueObject\BodyLength;
use DjThossi\SmokeTestingPhp\ValueObject\Concurrency;
use DjThossi\SmokeTestingPhp\ValueObject\ErrorMessage;
use DjThossi\SmokeTestingPhp\ValueObject\StatusCode;
use DjThossi\SmokeTestingPhp\ValueObject\TimeToFirstByte;
use DjThossi\SmokeTestingPhp\ValueObject\Url;

class CurlHttpRunner implements HttpRunner
{
    /**
     * @var BodyLength
     */
    private $bodyLength;

    /**
     * @var MultiCurl
     */
    private $multiCurl;

    /**
     * @var ResultCollection
     */
    private $results;

    /**
     * @param Concurrency $concurrency
     * @param BodyLength $bodyLength
     */
    public function __construct(Concurrency $concurrency, BodyLength $bodyLength)
    {
        $this->multiCurl = new MultiCurl();
        $this->multiCurl->setConcurrency($concurrency->asInteger());
        $this->multiCurl->success([$this, 'onSuccess']);
        $this->multiCurl->error([$this, 'onError']);
        $this->bodyLength = $bodyLength;
    }

    /**
     * @param RequestOptions $requestOptions
     */
    public function addRequest(RequestOptions $requestOptions)
    {
        $curl = new Curl();
        $curl->setUrl($requestOptions->getUrl()->asString());
        $curl->setTimeout($requestOptions->getTimeout()->inSeconds());
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, $requestOptions->getFollowRedirect()->asBoolean());

        if ($requestOptions->needsBasicAuth()) {
            $curl->setBasicAuthentication(
                $requestOptions->getBasicAuth()->getUsername(),
                $requestOptions->getBasicAuth()->getPassword()
            );
        }

        $this->multiCurl->addCurl($curl);
    }

    /**
     * @return ResultCollection
     */
    public function run()
    {
        $this->results = new ResultCollection();
        $this->multiCurl->start();

        return $this->results;
    }

    /**
     * @param Curl $curl
     */
    public function onSuccess(Curl $curl)
    {
        $curlInfo = $curl->getInfo();
        $timeToFirstByte = $curlInfo['starttransfer_time'] - $curlInfo['pretransfer_time'];
        $timeToFirstByteInMilliseconds = (int) round($timeToFirstByte * 1000);

        $body = substr($curl->response, 0, $this->bodyLength->asInteger());

        $this->results->addResult(
            new ValidResult(
                new Url($curl->url),
                new Body($body),
                new TimeToFirstByte($timeToFirstByteInMilliseconds),
                new StatusCode($curl->httpStatusCode)
            )
        );
    }

    /**
     * @param Curl $curl
     */
    public function onError(Curl $curl)
    {
        $url = new Url($curl->url);

        $errorMessage = new ErrorMessage(
            sprintf(
                'Curl Code: %s Error: %s',
                $curl->errorCode,
                $curl->errorMessage
            )
        );

        $errorResult = new ErrorResult($url, $errorMessage);

        $this->results->addResult($errorResult);
    }
}
