![Open Source Love](https://img.shields.io/badge/open-source-lightgrey?style=for-the-badge&logo=github)
![](https://img.shields.io/badge/Magento-2.4.x-orange?style=for-the-badge&logo=magento)
![](https://img.shields.io/badge/Maintained-yes-gren?style=for-the-badge&logo=magento)

### Magento 2 CloudFlare Cache Cleaner

Simple Magento 2 module that allows to clear CloudFlare cache from **CLI**

Installation (in your Magento 2 directory):\
**THIS PACKAGE REQUIRES COMPOSER 2.x** 
```bash
composer require enanobots/m2-cloudflare-cache-cleaner
```

And run upgrade command:
```bash
php bin/magento setup:upgrade
```

Module should work out-of-the box

### Tested on:
- Magento 2.4.2 Open Source
- Magento 2.4.3 Open Source
- Magento 2.4.4 Open Source
- Magento 2.4.5 Open Source

### How to use this module
Simply run `CLI` command:

```
php bin/magento  nanobots:cloudflare:cache-clear [--request] [param list] 
```

####  Examples:
```
php bin/magento  nanobots:cloudflare:cache-clear  --request=files https://www.store.com/ https://www.store.com/clear_this
php bin/magento  nanobots:cloudflare:cache-clear  --request=tags tag1 tag2 tag3
php bin/magento  nanobots:cloudflare:cache-clear  --request=hosts https://www.store.com/ 
```

Available requests:
- `files` - clear CF cache by URLs 
- `tags` - clear CF cache by tags
- `hosts` - clears CF cache by hosts
- `prefixes` - clears CF cache by prefixes
- `purge_everything` - clear entire CF cache associated to the specified ZONE

### Next update (coming soon... )
- adding logging and output regarding errors / issues
- adding ability to pass extra headers in the CLI
- adding admin UI to allow clearing CF from admin panel