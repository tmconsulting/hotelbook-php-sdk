<?php

declare(strict_types=1);

namespace Hotelbook\Object\Hotel;

/**
 * Class Type
 * @package App\Hotelbook\Object\Hotel
 */
class Type
{
    protected $id;
    protected $title;

    /**
     * Hotel type constructor.
     * @param int $id
     * @param string $title
     */
    public function __construct(int $id, string $title)
    {
        $this->setId($id);
        $this->setTitle($title);
    }

    /**
     * ID getter
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * ID setter
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Title getter
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Title setter
     * @param string $title
     * @return void
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}
