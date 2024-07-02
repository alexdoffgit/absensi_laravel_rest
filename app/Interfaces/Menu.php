<?php

namespace App\Interfaces;

interface Menu
{
    /**
     * @param array{
     *   userId?: int,
     *   deptId?: int,
     *   dlevel?: float
     * } $options
     * @return array
     */
    public function getMenuStructure($options);
}
