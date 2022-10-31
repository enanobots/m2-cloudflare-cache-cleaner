<?php

namespace Nanobots\CloudFlareCache\Api\Data;

interface ConfigInterface
{
    /**
     * @return int
     */
    public function getAuthType(): int;

    /**
     * @return null|string
     */
    public function getXAuthEmail(): ?string;

    /**
     * @return null|string
     */
    public function getXAuthKey(): ?string;

    /**
     * @return null|string
     */
    public function getAuthBearer(): ?string;

    /**
     * @return null|string
     */
    public function getV4Zone(): ?string;
}
