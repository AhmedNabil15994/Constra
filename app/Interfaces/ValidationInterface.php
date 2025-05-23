<?php

namespace App\Interfaces;

interface ValidationInterface
{
    /**
     * @param array $input
     * @return self
     */
    public function with(array $input);

    /**
     * @return boolean
     */
    public function passes();

    /**
     * @return array
     */
    public function errors();
}
