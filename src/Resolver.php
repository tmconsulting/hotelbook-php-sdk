<?php

declare(strict_types=1);

namespace App\Hotelbook;

use ReflectionClass;

trait Resolver
{
    /**
     * @var array
     */
    private $methods = [];

    /**
     * @var array
     */
    private $instances = [];

    public function setMethod(string $name, string $method)
    {
        $this->methods[$name] = $method;
    }

    public function getMethod($name)
    {
        if (!empty($this->instances[$name])) {
            return $this->instances[$name];
        }

        return $this->instantiateMethod($name);
    }

    protected function saveInstance($name, $instance)
    {
        $this->instances[$name] = $instance;
        return $instance;
    }

    protected function instantiateMethod($name)
    {
        $instance = (new ReflectionClass($this->methods[$name]))->newInstanceArgs([$this->connector]);
        return $this->saveInstance($name, $instance);
    }

    /**
     * @param $name
     * @param array $params
     * @return mixed
     */
    private function callMethod($name, array $params = [])
    {
        $method = $this->getMethod($name);
        $requestToSend = $method->build($params);
        return $method->handle($requestToSend);
    }
}
