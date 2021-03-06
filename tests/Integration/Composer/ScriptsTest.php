<?php
declare(strict_types=1);

namespace PhpList\PhpList4\Tests\Integration\Composer;

use PHPUnit\Framework\TestCase;

/**
 * Testcase.
 *
 * @author Oliver Klee <oliver@phplist.com>
 */
class ScriptsTest extends TestCase
{
    /**
     * @return string
     */
    private function getBundleConfigurationFilePath(): string
    {
        return dirname(__DIR__, 3) . '/Configuration/bundles.yml';
    }

    /**
     * @test
     */
    public function bundleConfigurationFileExists()
    {
        static::assertFileExists($this->getBundleConfigurationFilePath());
    }

    /**
     * @return string[][]
     */
    public function bundleClassNameDataProvider(): array
    {
        return [
            'Symfony framework bundle' => ['Symfony\\Bundle\\FrameworkBundle\\FrameworkBundle'],
            'sensio framework extras' => ['Sensio\\Bundle\\FrameworkExtraBundle\\SensioFrameworkExtraBundle'],
            'Doctrine bundle' => ['Doctrine\\Bundle\\DoctrineBundle\\DoctrineBundle'],
            'empty start page bundle' => ['PhpList\\PhpList4\\EmptyStartPageBundle\\PhpListEmptyStartPageBundle'],
        ];
    }

    /**
     * @test
     * @param string $bundleClassName
     * @dataProvider bundleClassNameDataProvider
     */
    public function bundleConfigurationFileContainsModuleBundles(string $bundleClassName)
    {
        $fileContents = file_get_contents($this->getBundleConfigurationFilePath());

        static::assertContains($bundleClassName, $fileContents);
    }

    /**
     * @return string
     */
    private function getModuleRoutesConfigurationFilePath(): string
    {
        return dirname(__DIR__, 3) . '/Configuration/routing_modules.yml';
    }

    /**
     * @test
     */
    public function moduleRoutesConfigurationFileExists()
    {
        static::assertFileExists($this->getModuleRoutesConfigurationFilePath());
    }

    /**
     * @return string[][]
     */
    public function moduleRoutingDataProvider(): array
    {
        return [
            'route name' => ['phplist/phplist4-core.homepage'],
            'resource' => ["resource: '@PhpListEmptyStartPageBundle/Controller/'"],
            'type' => ['type: annotation'],
        ];
    }

    /**
     * @test
     * @param string $routeSearchString
     * @dataProvider moduleRoutingDataProvider
     */
    public function moduleRoutesConfigurationFileContainsModuleRoutes(string $routeSearchString)
    {
        $fileContents = file_get_contents($this->getModuleRoutesConfigurationFilePath());

        static::assertContains($routeSearchString, $fileContents);
    }

    /**
     * @test
     */
    public function parametersConfigurationFileExists()
    {
        static::assertFileExists(dirname(__DIR__, 3) . '/Configuration/parameters.yml');
    }

    /**
     * @test
     */
    public function modulesConfigurationFileExists()
    {
        static::assertFileExists(dirname(__DIR__, 3) . '/Configuration/config_modules.yml');
    }
}
