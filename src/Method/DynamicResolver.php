<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/18/17
 */

namespace App\Hotelbook\Method;

trait DynamicResolver
{
    /**
     * @var array
     */
    private $methods = [];

    /**
     * @param $name
     * @param \App\Hotelbook\Method\MethodInterface $method
     */
    public function setMethod($name, MethodInterface $method)
    {
        $this->methods[$name] = $method;
    }

    /**
     * @param $name
     * @param array $params
     * @return mixed
     */
    private function callMethod($name, array $params = [])
    {
        echo 'RUN METHOD ' . $name . "\n";
        $method = $this->getMethod($name);
        echo 'BUILD METHOD ' . $name . "\n";
        $requestToSend =     $method->build($params);

        echo 'QUERY METHOD ' . $name . "\n";
        return $method->handle($requestToSend);
    }

    /**
     * @param $name
     * @return \App\Hotelbook\Method\MethodInterface
     */
    public function getMethod($name)
    {
        return $this->methods[$name];
    }
}
