<?php
/**
 * Copyright © Q-Solutions Studio: eCommerce Nanobots. All rights reserved.
 *
 * @category    Nanobots
 * @package     Nanobots_CloudFlareCache
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com
 */

namespace Nanobots\CloudFlareCache\Console;

use Nanobots\CloudFlareCache\Api\CacheInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearCache extends Command
{
    /** @var string  */
    public const NAME = 'nanobots:cloudflare:cache-clear';

    /** @var string */
    public const DESCRIPTION = 'Clear CloudFlare cache';

    /** @var string[]  */
    public const ACCEPTED_REQUESTS = ['purge_everything', 'files', 'tags', 'hosts', 'prefixes'];

    /** @var string  */
    public const INPUT_REQUEST = 'request';

    /** @var string  */
    public const ARGUMENT_DATA = 'data';

    /** @var CacheInterface  */
    protected CacheInterface $cloudFlare;

    /**
     * @param string|null $name
     */
    public function __construct(
        CacheInterface $cloudFlare,
        string $name = null
    ) {
        $this->cloudFlare = $cloudFlare;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(self::NAME)
            ->setDescription(self::DESCRIPTION)
            ->setDefinition([
                new InputOption(
                    self::INPUT_REQUEST,
                    null,
                    InputOption::VALUE_REQUIRED,
                    'Request must contain one of "purge_everything", "files", "tags", "hosts" or "prefixes"'
                ),
                new InputArgument(
                    self::ARGUMENT_DATA,
                    InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
                    'Lists of tags, URLs, hosts, prefixes, 30 is CloudFlare limit',
                    []
                )
            ]);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $request = $input->getOption(self::INPUT_REQUEST);
        if (!in_array($request, self::ACCEPTED_REQUESTS)) {
            throw new \Exception(__('Request %1 Type not recognized', $request));
        }
        $data = $input->getArgument(self::ARGUMENT_DATA);

        if ($data) {
            switch ($request) {
                case 'files':
                {
                    $this->cloudFlare->clearCfCacheByFiles($data);
                    break;
                }
                case 'tags':
                {
                    $this->cloudFlare->clearCacheByTags($data);
                    break;
                }
                case 'hosts':
                {
                    $this->cloudFlare->clearCfCacheByHosts($data);
                    break;
                }
                case 'prefixes':
                {
                    $this->cloudFlare->clearCfCacheByPrefixes($data);
                    break;
                }
                case 'purge_everything':
                {
                    $this->cloudFlare->purgeCfCache($data);
                    break;
                }
            }
        }
    }
}
