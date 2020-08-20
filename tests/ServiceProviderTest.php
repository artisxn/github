<?php

declare(strict_types=1);

/*
 * This file is part of Laravel GitHub.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace codicastudio\Tests\GitHub;

use Github\Client;
use codicastudio\GitHub\Auth\AuthenticatorFactory;
use codicastudio\GitHub\Cache\ConnectionFactory;
use codicastudio\GitHub\GitHubFactory;
use codicastudio\GitHub\GitHubManager;
use codicastudio\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testAuthFactoryIsInjectable()
    {
        $this->assertIsInjectable(AuthenticatorFactory::class);
    }

    public function testCacheFactoryIsInjectable()
    {
        $this->assertIsInjectable(ConnectionFactory::class);
    }

    public function testGitHubFactoryIsInjectable()
    {
        $this->assertIsInjectable(GitHubFactory::class);
    }

    public function testGitHubManagerIsInjectable()
    {
        $this->assertIsInjectable(GitHubManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['github.connection'];
        $this->app['github']->reconnect();
        $new = $this->app['github.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
