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
        // $name = posts
        // 目标:
        // $class = 'Rebuy\\Post'
        
        // 1. 第一个字母大写 => Posts
        $class = strtoupper(substr($name, 0, 1)) . substr($name, 1);

        // 2. 从复数转单数 => Rebuy\Post
        $class = __NAMESPACE__ . '\\' . str_singular($class);

        return $class::count();
    }
}