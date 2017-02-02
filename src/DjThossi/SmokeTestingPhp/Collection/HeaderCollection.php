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
     * @return bool
     */
    public function headerKeyExists(HeaderKey $searchKey)
    {
        /**
         * @var Header $header
         */
        foreach ($this as $header) {
            if ($searchKey->asString() === $header->getKey()->asString()) {
                return true;
            }
        }

        return false;
    }
}
