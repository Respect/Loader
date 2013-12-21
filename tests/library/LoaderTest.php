<?php

namespace Respect;

class LoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Respect\Loader
     */
    private $autoloader;
    /**
     * @var string
     */
    private $includePath;
    /**
     * @var string
     */
    private $loaderFilePath;

    public function assertPreConditions()
    {
        $this->assertTrue(
            defined($constantName = 'ROOT_PATH'),
            sprintf('Expected constant "%s" to be declared. Was `tests/bootstrap.php` even loaded?!', $constantName)
        );
        $this->assertNotEmpty(
            ROOT_PATH,
            'The ROOT_PATH constant (poiting to the root directory of the library) should not be empty.'
        );
        $this->assertTrue(
            defined($constantName = 'FIXTURE_PATH'),
            sprintf('Expected constant "%s" to be declared. Was `tests/bootstrap.php` even loaded?!', $constantName)
        );
        $this->assertContains(
            $fixturePath = constant($constantName),
            $includePath = $this->includePath = get_include_path(),
            sprintf('Class fixure path "%s" should be on PHP\'s include_path (%s).', $fixturePath, $includePath)
        );

        $this->assertTrue(
            class_exists($className = 'Respect\Loader'),
            sprintf('Expect to able to (at least) load class "%s" using Composer\'s autoload.',$className)
        );
    }

    public function setUp()
    {
        $this->autoloader = new Loader;
        $loaderReflection = new \ReflectionObject($this->autoloader);
        $this->loaderFilePath = $loaderReflection->getFileName();
        spl_autoload_register($this->autoloader);
    }

    public function tearDown()
    {
       spl_autoload_unregister($this->autoloader);
    }

    /**
     * @test
     */
    public function Loads_from_IncludePath_class_using_Pear_naming_convention()
    {
        $className = 'Pear_Fixture_Example';
        $this->assertFileExists(
            $fileName = $this->autoloader->findFileFromClassName($className),
            sprintf('Failed to find "%s" for class "%s" on include_path: %s', $fileName, $className, $this->includePath)
        );
        $this->assertInstanceOf(
            $className,
            new $className
        );
    }

    /**
     * @test
     */
    public function Loads_from_IncludePath_class_using_PSR0_naming_convention()
    {
        $className = 'Psr0\Fixture\Example';
        $this->assertFileExists(
            $fileName = $this->autoloader->findFileFromClassName($className),
            sprintf('Failed to find "%s" for class "%s" on include_path: %s', $fileName, $className, $this->includePath)
        );
        $this->assertInstanceOf(
            $className,
            new $className
        );
    }

    /**
     * @test
     */
    public function Class_is_callable()
    {
        $this->assertTrue(
            is_callable($this->autoloader),
            'The instance should be callable.'
        );
    }

    /**
     * @test
     * @ runInSeparateProcess
     * @ preserveGlobalState disabled
     */
    public function Including_file_should_return_a_Loader_instance_by_default()
    {
        $this->markTestIncomplete('PHPUnit is fucking me around...');
        $returnedInstance = include $this->loaderFilePath;
        $this->assertInstanceOf(
            $className = 'Respect\Loder',
            $returnedInstance,
            sprintf('Expected an instance of "%s" to be returned from include().', $className)
        );
    }

    /**
     * @test
     */
    public function Incliding_file_with_constant_to_ignore_instantiation_should_not_return_a_Loader_instance()
    {
        $this->markTestIncomplete();
    }
}

