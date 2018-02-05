<?php

namespace App\Services;

class LocationService
{
    /**
     * LocationService constructor.
     */
    public function __construct()
    {
        $this->collection = collect();
    }

    /**
     * Create tree localization
     */
    public function createTreeLocation($location)
    {
        $method_class = $this->getMyClass($location);

        if ($method_class != null) {
        if (is_array($method_class)) {
            foreach ($method_class as $method) {
                if ($location->$method->count() > 0) {
                    foreach ($location->$method as $item) {
                        $this->createTreeLocation($item);
                    }
                }
            }

        } else if ($location->$method_class->count() > 0 ) {
            foreach ($location->$method_class as $item) {
                $this->collection->push($item);
                $this->createTreeLocation($item);
            }
        }

        }
        return $this->collection;

    }

    /**
     * Return object class name.
     *
     * @param $object
     * @return array|string
     */
    private function getMyClass($object)
    {
        $myclass = (new \ReflectionClass($object))->getShortName();

        return $this->getMethodGetChild($myclass);
    }

    /**
     * Return name method to get child.
     *
     * @param $myclass
     * @return array|string
     */
    private function getMethodGetChild($myclass)
    {
        switch ($myclass) {
            case 'Country':
                $method = 'states';
                break;
            case 'State':
                $method = ['cities', 'counties'];
                break;
            case 'County':
                $method = 'cities';
                break;
            default:
                $method = null;
                break;
        }

        return $method;
    }

}