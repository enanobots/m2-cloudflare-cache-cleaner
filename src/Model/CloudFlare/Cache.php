<?php

namespace Nanobots\CloudFlareCache\Model\CloudFlare;

use GuzzleHttp\Client;
use Nanobots\CloudFlareCache\Api\CacheInterface;
use Nanobots\CloudFlareCache\Api\Data\ConfigInterface;
use Psr\Http\Message\ResponseInterface;

class Cache implements CacheInterface
{
    /** @var string  */
    const CONTENT_TYPE_APPLICATION_JSON = 'application/json';

    /** @var string  */
    const X_AUTH_EMAIL = 'X-Auth-Email: %s';

    /** @var string  */
    const X_AUTH_KEY = 'X-Auth-Key: %s';

    /** @var string  */
    const AUTHORIZATION_BEARER = 'Bearer %s';
    const HEADERS = 'headers';

    /** @var Client  */
    protected Client $httpClient;

    /** @var ConfigInterface  */
    protected ConfigInterface $config;

    /** @var array  */
    protected array $extraHeaders = [];

    /**
     * @return array
     */
    public function getExtraHeaders(): array
    {
        return $this->extraHeaders;
    }

    /**
     * @param array $extraHeaders
     */
    public function setExtraHeaders(array $extraHeaders): void
    {
        $this->extraHeaders = $extraHeaders;
    }

    /**
     * @param ConfigInterface $config
     * @param Client $httpClient
     */
    public function __construct(
        ConfigInterface $config,
        Client $httpClient
    ) {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function clearCache(string $jsonData): \Psr\Http\Message\ResponseInterface
    {
        return $this->httpClient->post(
            $this->buildUrl(),
            [
                \GuzzleHttp\RequestOptions::HEADERS => $this->buildHeaders(),
                \GuzzleHttp\RequestOptions::JSON => $jsonData
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function buildUrl(): string
    {
        return sprintf(self::CLOUD_FLARE_API, $this->config->getV4Zone());
    }

    /**
     * @inheritDoc
     */
    public function buildHeaders(): array
    {
        $headers['Content-Type'] = self::CONTENT_TYPE_APPLICATION_JSON;
        switch ($this->config->getAuthType()) {
            case self::AUTH_TYPE_XTYPE: {
                $headers[] = sprintf(self::X_AUTH_EMAIL, $this->config->getXAuthEmail());
                $headers[] = sprintf(self::X_AUTH_KEY, $this->config->getXAuthKey());
                break;
            }

            case self::AUTH_TYPE_BEARER: {
                $headers['Authorization'] = sprintf(self::AUTHORIZATION_BEARER, $this->config->getAuthBearer());
                break;
            }
        }
        return $headers;
    }

    /**
     * @inheritDoc
     */
    public function purgeCfCache(): ResponseInterface
    {
        return $this->clearCache(
            json_encode(['purge_everything' => true])
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCacheByTags(array $tags): ResponseInterface
    {
        $json = $this->prepareJSON($tags, 'tags');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCfCacheByFiles(array $files): ResponseInterface
    {
        $json = $this->prepareJSON($files, 'files');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCfCacheByHosts(array $hosts): ResponseInterface
    {
        $json = $this->prepareJSON($hosts, 'hosts');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @inheritDoc
     */
    public function clearCfCacheByPrefixes(array $prefixes): ResponseInterface
    {
        $json = $this->prepareJSON($prefixes, 'prefixes');
        return $this->clearCache(
            $json
        );
    }

    /**
     * @param array $data
     * @param string $arrayKey
     * @return false|string
     */
    public function prepareJSON(array $data, string $arrayKey)
    {
        if ($extraHeaders = $this->getExtraHeaders()) {
            $json = json_encode(
                [
                    $arrayKey => $data,
                    self::HEADERS => $extraHeaders
                ]
            );
        } else {
            $json = json_encode([
                $arrayKey => $data
            ]);
        }
        return $json;
    }
}
