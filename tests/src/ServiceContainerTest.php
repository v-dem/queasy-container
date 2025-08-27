<?php

/*
 * Queasy PHP Framework - Service Container - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\container\tests;

use PHPUnit\Framework\TestCase;

use queasy\container\ServiceContainer;
use queasy\container\NotFoundException;
use queasy\container\ContainerException;

class ServiceContainerTest extends TestCase
{
    public function testCreateEmptyContainer()
    {
        $this->expectNotToPerformAssertions();

        $container = new ServiceContainer([]);
    }

    public function testCheckServiceNotConfigured()
    {
        $container = new ServiceContainer([]);

        $this->assertFalse($container->has('myService'));
    }

    public function  testCheckServiceConfigured()
    {
        $container = new ServiceContainer([
            'myService' => 123
        ]);

        $this->assertTrue($container->has('myService'));
    }
}

