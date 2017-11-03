<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/18/17
 */

namespace App\Hotelbook\Object\Hotel;

final class BookItem
{
    /**
     * @var string
     */
    private $searchId;

    /**
     * @var string
     */
    private $resultId;

    /**
     * @var BookPassenger[][]
     */
    private $rooms = [];

    /**
     * BookItem constructor.
     *
     * @param $searchId
     * @param $resultId
     */
    public function __construct(string $searchId, string $resultId)
    {
        $this->searchId = $searchId;
        $this->resultId = $resultId;
    }

    /**
     * @return mixed
     */
    public function getSearchId()
    {
        return $this->searchId;
    }

    /**
     * @param mixed $searchId
     */
    public function setSearchId($searchId)
    {
        $this->searchId = $searchId;
    }

    /**
     * @return mixed
     */
    public function getResultId()
    {
        return $this->resultId;
    }

    /**
     * @param mixed $resultId
     */
    public function setResultId($resultId)
    {
        $this->resultId = $resultId;
    }

    /**
     * @return array
     */
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * @param array $room
     */
    public function addRoom(array $room)
    {
        $this->rooms[] = $room;
    }
}
