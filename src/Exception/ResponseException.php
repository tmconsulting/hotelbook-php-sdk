<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 25.03.16
 * Project: m2m
 */

declare(strict_types=1);

namespace App\Hotelbook\Exception;

class ResponseException extends \Exception
{
    /**
     * @var int|string
     */
    protected $code;
    /**
     * @var string
     */
    protected $message;

    /**
     * Error constructor.
     *
     * @param null $code
     * @param null $message
     * @param \Exception $previous
     */
    public function __construct($code = null, $message = null, \Exception $previous = null)
    {
        $this->code = $code;
        $this->message = $message;

        parent::__construct($message, $code, $previous);
    }
}