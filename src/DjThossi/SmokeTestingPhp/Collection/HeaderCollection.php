<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\ValueObject\Header;
use DjThossi\SmokeTestingPhp\ValueObject\HeaderKey;

class HeaderCollection extends BaseCollection
{
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
}
