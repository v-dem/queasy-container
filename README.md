[![Total Downloads](https://poser.pugx.org/v-dem/queasy-container/downloads)](https://packagist.org/packages/v-dem/queasy-container)
[![Latest Stable Version](https://img.shields.io/github/v/release/v-dem/queasy-container)](https://packagist.org/packages/v-dem/queasy-container)
[![License](https://poser.pugx.org/v-dem/queasy-container/license)](https://packagist.org/packages/v-dem/queasy-container)

# [QuEasy PHP Framework](https://github.com/v-dem/queasy-container/) - Service Container

## Package `v-dem/queasy-container`

Lightweight implementation of PSR-11 Container Interface

### Requirements

*   PHP version 5.3 or higher

### Installation

    composer require v-dem/queasy-container

### Usage

#### Initialization

Each item in array passed to `ServiceContainer` constructor should be callable which returns instance of of requested service.

```php
$container = new queasy\container\ServiceContainer([
    'logger' => function($container) {
        return new queasy\log\Logger([
            'path' => __DIR__ . '/logs/debug.log'
        ]);
    }
]);

$container->logger->debug('Test');
```

