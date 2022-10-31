<?php

namespace Nanobots\CloudFlareCache\Model\Config\Source;

class AuthType
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Authorization Bearer')],
            ['value' => 0, 'label' => __('X-Auth')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            1 => __('Authorization Bearer'),
            0 => __('X-Auth')
        ];
    }
}
