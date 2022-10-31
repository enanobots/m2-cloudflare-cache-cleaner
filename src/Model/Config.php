<?php
/**
 * Copyright © Q-Solutions Studio: eCommerce Nanobots. All rights reserved.
 *
 * @category    Nanobots
 * @package     Nanobots_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com
 */

namespace Nanobots\CloudFlareCache\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Nanobots\CloudFlareCache\Api\Data\ConfigInterface;

class Config implements ConfigInterface
{
    /** @var ScopeConfigInterface  */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @inheritDoc
     */
    public function getAuthType(): int
    {
        return (int)$this->scopeConfig->getValue(
            'nanobots/cloudflarecache/auth_type',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getXAuthEmail(): ?string
    {
        return $this->scopeConfig->getValue(
            'nanobots/cloudflarecache/xauth_email',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getXAuthKey(): ?string
    {
        return $this->scopeConfig->getValue(
            'nanobots/cloudflarecache/xauth_key',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getAuthBearer(): ?string
    {
        return $this->scopeConfig->getValue(
            'nanobots/cloudflarecache/auth_bearer',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @inheritDoc
     */
    public function getV4Zone(): ?string
    {
        return $this->scopeConfig->getValue(
            'nanobots/cloudflarecache/v4_zone',
            ScopeInterface::SCOPE_STORE
        );
    }
}
