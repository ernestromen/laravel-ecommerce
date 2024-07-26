<?php

namespace App\Helpers;

class Helper
{
    static function findEntityName($entity)
    {
        $route = get_class($entity->first());
        $arrayOfRoute = explode('\\', $route);
        $lengthOfRouteArray = count($arrayOfRoute);
        $finalEntityName = $arrayOfRoute[$lengthOfRouteArray - 1];
        return $finalEntityName;
    }
}
