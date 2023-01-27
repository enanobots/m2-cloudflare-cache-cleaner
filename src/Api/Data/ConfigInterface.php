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
    /** @var string  */
    const XPATH_NANOBOTS_CLOUDFLARECACHE_XAUTH_KEY = 'nanobots/cloudflarecache/xauth_key';

    /** @var string  */
    const XPATH_NANOBOTS_CLOUDFLARECACHE_XAUTH_EMAIL = 'nanobots/cloudflarecache/xauth_email';

    /** @var string  */
    const XPATH_NANOBOTS_CLOUDFLARECACHE_AUTH_BEARER = 'nanobots/cloudflarecache/auth_bearer';

    /** @var string  */
    const XPATH_NANOBOTS_CLOUDFLARECACHE_V_4_ZONE = 'nanobots/cloudflarecache/v4_zone';

    /** @var string  */
    const XPATH_NANOBOTS_CLOUDFLARECACHE_AUTH_TYPE = 'nanobots/cloudflarecache/auth_type';

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
