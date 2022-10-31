<?php
/**
 * Copyright © Q-Solutions Studio: eCommerce Nanobots. All rights reserved.
 *
 * @category    Nanobots
 * @package     Nanobots_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com
 */

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
