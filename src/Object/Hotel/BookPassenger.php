<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/18/17
 */

namespace App\Hotelbook\Object\Hotel;

final class BookPassenger
{
    /**
     * @var bool
     */
    private $child;

    /**
     * @var int
     */
    private $age;

    /**
     * @var bool
     */
    private $adultPlace;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * BookPassenger constructor.
     *
     * @param string $title
     * @param string $firstName
     * @param string $lastName
     * @param bool $adultPlace
     * @param bool $child
     * @param int $age
     */
    public function __construct(
        string $title,
        string $firstName,
        string $lastName,
        bool $child = false,
        bool $adultPlace = false,
        ?int $age = null
    )
    {
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->adultPlace = $adultPlace;
        $this->child = $child;
        $this->age = $age;
    }

    /**
     * @return bool
     */
    public function isChild(): bool
    {
        return $this->child;
    }

    /**
     * @param bool $child
     */
    public function setChild(bool $child)
    {
        $this->child = $child;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /**
     * @return bool
     */
    public function isAdultPlace(): bool
    {
        return $this->adultPlace;
    }

    /**
     * @param bool $adultPlace
     */
    public function setAdultPlace(bool $adultPlace)
    {
        $this->adultPlace = $adultPlace;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }
}
