<?php
namespace DjThossi\SmokeTestingPhp;

use Curl\Curl;
use Curl\MultiCurl;
use PHPUnit_Framework_TestCase;

abstract class SmokeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @throws SmokeTestException
     *
     * @return ResultInterface[]
     */
    public function resultProvider()
    {
        return $this->getResults($this->getMaxCurlTimeoutInSeconds());
    }

    /**
     * @param $timeoutInSeconds
     *
     * @throws SmokeTestException
     *
     * @return array
     */
    private function getResults($timeoutInSeconds)
    {
        $username = $this->getBasicAuthUsername();
        $password = $this->getBasicAuthPassword();

        $urls = $this->createList($username, $password, $timeoutInSeconds);

        return $this->processUrls($urls);
    }

    /**
     * @param $urls
     *
     * @return array
     */
    private function processUrls($urls)
    {
        $results = [];
        $maxParallelRequests = $this->getMaxParallelRequests();
        for ($offset = 0; $offset < count($urls); $offset += $maxParallelRequests) {
            $slice = array_slice($urls, $offset, $maxParallelRequests, true);
            $resultSlice = $this->checkUrls($slice);

            foreach ($resultSlice as $key => $result) {
                $results[$key] = [$result];
            }
        }

        echo "\n";

        return $results;
    }

    /**
     * @param SmokeTestUrl[] $urls
     *
     * @return ResultInterface[]
     */
    private function checkUrls(array $urls)
    {
        $results = [];

        $multiCurl = new MultiCurl();

        $multiCurl->success(
            function (Curl $curl) use (&$results, $urls) {
                $curlInfo = $curl->getInfo();
                $timeToFirstByte = $curlInfo['starttransfer_time'] - $curlInfo['pretransfer_time'];

                if ($this->getMaxBodyToPreserve() !== null) {
                    $body = substr($curl->response, 0, $this->getMaxBodyToPreserve());
                } else {
                    $body = $curl->response;
                }

                $results[$curl->url] = new Result($body, $timeToFirstByte, $curl->httpStatusCode);
            }
        );

        $multiCurl->error(
            function (Curl $curl) use (&$results) {
                $results[$curl->url] = new ErrorResult(
                    sprintf(
                        'Curl Code: %s Error: %s',
                        $curl->errorCode,
                        $curl->errorMessage
                    )
                );
            }
        );

        foreach ($urls as $smokeTestUrl) {
            echo '.';
            $curl = new Curl();
            $curl->setTimeout($smokeTestUrl->getTimeoutInSeconds());
            //TODO Move this into SmokeTestUrl
            $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
            $curl->setUrl($smokeTestUrl->getUrl());

            if ($smokeTestUrl->needsBasicAuth()) {
                $curl->setBasicAuthentication($smokeTestUrl->getUsername(), $smokeTestUrl->getPassword());
            }

            $multiCurl->addCurl($curl);
        }

        $multiCurl->start();

        return $results;
    }

    /**
     * @param string $username
     * @param string $password
     * @param int $timeoutInSeconds
     *
     * @throws SmokeTestException
     *
     * @return array
     */
    protected function createList($username, $password, $timeoutInSeconds)
    {
        /** @var string[] $urls */
        $urls = file($this->getUrlsFile());

        $data = [];
        foreach ($urls as $url) {
            $url = trim($url);
            if (!empty($url)) {
                $smokeTestUrl = new SmokeTestUrl($url, $timeoutInSeconds, $username, $password);
                $data[$smokeTestUrl->getUrl()] = $smokeTestUrl;
            }
        }

        if (empty($data)) {
            throw new SmokeTestException('Data set for urls is empty.');
        }

        return $data;
    }

    /**
     * @return string
     */
    abstract protected function getUrlsFile();

    /**
     * @return string
     */
    abstract protected function getBasicAuthUsername();

    /**
     * @return string
     */
    abstract protected function getBasicAuthPassword();

    /**
     * @return int
     */
    abstract protected function getMaxCurlTimeoutInSeconds();

    /**
     * @return int
     */
    abstract protected function getMaxParallelRequests();

    /**
     * @return int
     */
    abstract protected function getMaxBodyToPreserve();
}
