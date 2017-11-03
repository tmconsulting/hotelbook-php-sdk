<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 10/17/17
 */

namespace App\Hotelbook\Method;


interface MethodInterface
{
    /**
     * @param $params
     * @return mixed
     */
    public function build($params);

    /**
     * @param $results
     * @return mixed
     */
    public function handle($results);
}