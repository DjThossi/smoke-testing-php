<?php
namespace DjThossi\SmokeTestingPhp;

use Curl\Curl;
use Curl\MultiCurl;

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

        $body = substr($curl->response, 0, $this->bodyLength->asInteger());

        $timeToFirstByteInMilliseconds = round($timeToFirstByte * 1000);

        $this->results->addResult(
            new ValidResult(
                new Url($curl->url),
                $body,
                $timeToFirstByteInMilliseconds,
                $curl->httpStatusCode
            )
        );
    }

    /**
     * @param Curl $curl
     */
    public function onError(Curl $curl)
    {
        $this->results->addResult(
            new ErrorResult(
                new Url($curl->url),
                sprintf(
                    'Curl Code: %s Error: %s',
                    $curl->errorCode,
                    $curl->errorMessage
                )
            )
        );
    }
}
