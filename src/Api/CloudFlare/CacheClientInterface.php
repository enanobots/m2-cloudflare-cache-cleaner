<?php
/**
 * Copyright © Q-Solutions Studio: eCommerce Nanobots. All rights reserved.
 *
 * @category    Nanobots
 * @package     Nanobots_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com
 */

namespace Nanobots\CloudFlareCache\Api\CloudFlare;

use Psr\Http\Message\ResponseInterface;
interface CacheClientInterface
{
    /** @var string  */
    public const CLOUD_FLARE_API = 'https://api.cloudflare.com/client/v4/zones/%s/purge_cache';

    /** @var int  */
    public const AUTH_TYPE_XTYPE = 0;

    /** @var int  */
    public const AUTH_TYPE_BEARER = 1;

    /**
     * @return array
     */
    public function getExtraHeaders(): array;

    /**
     * @param array $extraHeaders
     * @return void
     */
    public function setExtraHeaders(array $extraHeaders): void;

    /**
     * @return string
     */
    public function buildUrl(): string;

    /**
     * @return array
     */
    public function buildHeaders(): array;

    /**
     * @param string $jsonData
     * @return ResponseInterface
     */
    public function clearCache(string $jsonData): ResponseInterface;

    /**
     * @return ResponseInterface
     */
    public function purgeCfCache(): ResponseInterface;

    /**
     * @param array $tags
     * @return ResponseInterface;
     */
    public function clearCacheByTags(array $tags): ResponseInterface;

    /**
     * @param array $files
     * @return ResponseInterface;
     */
    public function clearCfCacheByFiles(array $files): ResponseInterface;

    /**
     * @param array $hosts
     * @return ResponseInterface;
     */
    public function clearCfCacheByHosts(array $hosts): ResponseInterface;

    /**
     * @param array $prefixes
     * @return ResponseInterface;
     */
    public function clearCfCacheByPrefixes(array $prefixes): ResponseInterface;
}
