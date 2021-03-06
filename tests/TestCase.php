<?php

namespace Spatie\Enum\Laravel\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\Enum\Laravel\EnumServiceProvider;
use Spatie\Enum\Laravel\Tests\Extra\InvalidNullablePost;
use Spatie\Enum\Laravel\Tests\Extra\Post;

abstract class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        Post::migrate();
        InvalidNullablePost::migrate();
    }

    protected function getPackageProviders($app)
    {
        return [
            EnumServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');

        config()->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    public function getStub(string $file): string
    {
        return file_get_contents(__DIR__.'/stubs/'.$file);
    }
}
