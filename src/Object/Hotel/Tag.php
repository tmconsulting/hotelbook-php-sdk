<?php

declare(strict_types=1);

namespace Hotelbook\Object\Hotel;

/**
 * Class Tag
 * @package App\Hotelbook\Object\Hotel
 */
class Tag
{
    private $tagId;

    /**
     * Tag constructor.
     * @param $tagId
     */
    public function __construct($tagId)
    {
        $this->setTag($tagId);
    }

    /**
     * Tag setter
     * @param $tagId
     */
    public function setTag($tagId)
    {
        $this->tagId = (string)$tagId;
    }

    /**
     * Tag getter
     * @return mixed
     */
    public function getTag()
    {
        return $this->tagId;
    }
}
