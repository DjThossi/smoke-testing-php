<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;

class HeaderCollection extends BaseCollection
{
    /**
     * @param array $headerData
     *
     * @return HeaderCollection
     */
    public static function fromArray(array $headerData)
    {
        $headerCollection = new self();
        foreach ($headerData as $key => $value) {
            $header = Header::fromPrimitives($key, $value);
            $headerCollection->addHeader($header);
        }

        return $headerCollection;
    }

    /**
     * @param Header $header
     */
    public function addHeader(Header $header)
    {
        $this->addElement($header);
    }

    /**
     * @return Header
     */
    public function current()
    {
        return $this->getCurrent();
    }

    /**
     * @param HeaderKey $searchKey
     *
     * @throws HeaderNotFoundException
     *
     * @return Header
     */
    public function getHeader(HeaderKey $searchKey)
    {
        foreach ($this as $header) {
            if ($searchKey->asString() === $header->getKey()->asString()) {
                return $header;
            }
        }

        throw new HeaderNotFoundException($searchKey);
    }

    /**
     * @param HeaderKey $searchKey
     *
     * @return bool
     */
    public function headerKeyExists(HeaderKey $searchKey)
    {
        try {
            return $this->getHeader($searchKey) !== null;
        } catch (HeaderNotFoundException $exception) {
            return false;
        }
    }

    /**
     * @param Header $searchHeader
     *
     * @return bool
     */
    public function headerExists(Header $searchHeader)
    {
        try {
            $header = $this->getHeader($searchHeader->getKey());

            return $header->getValue()->asString() === $searchHeader->getValue()->asString();
        } catch (HeaderNotFoundException $exception) {
            return false;
        }
    }
}
