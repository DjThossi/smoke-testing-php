<?php
namespace DjThossi\SmokeTestingPhp\Collection;

use DjThossi\SmokeTestingPhp\ValueObject\Header;

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
}
