<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 26.04.16
 * Project: provider
 */

declare(strict_types=1);

namespace App\Hotelbook\Object;

/**
 * Class Error
 *
 * @package Driver
 */
class Error
{
    /**
     * @var mixed
     */
    protected $code;

    /**
     * @var string
     */
    protected $message;

    /**
     * Error constructor.
     *
     * @param string $message
     * @param null $code
     */
    public function __construct($message, $code = null)
    {
        $this->setCode($code);
        $this->setMessage($message);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
