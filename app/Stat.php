<?php

namespace Rebuy;

class Stat {

    /**
     * Get the count of the scoped users.
     *
     * @param string $scope
     * @return mixed
     */
    public function users($scope = 'yesterday')
    {
        switch ($scope) {
            case 'today':
                return User::today()->count();
            case 'all':
                return User::count();
            default:
                return User::yesterday()->count();
        }
    }

    /**
     * Magically call the methods.
     * 
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $class = __NAMESPACE__ . '\\' . str_singular(strtoupper(substr($name, 0, 1)) . substr($name, 1));

        return $class::count();
    }
}