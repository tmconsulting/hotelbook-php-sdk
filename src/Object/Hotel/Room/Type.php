<?php

declare(strict_types=1);

namespace App\Hotelbook\Object\Hotel\Room;

class Type
{
    protected $id;
    protected $name;

    /**
     * Room Type constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
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
     * Name getter
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Name setter
     * @param string $name
     * @return void
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }
}