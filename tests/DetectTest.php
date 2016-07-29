<?php
/**
 * The file for the detect-environment context tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\DetectEnvironment;

use Jstewmc\TestCase\TestCase;

/**
 * Tests for the detect-environment context
 */
class DetectTest extends TestCase
{
    /* !__construct() */
    
    /**
     * __construct() should set the environment variable's name
     */
    public function testConstruct()
    {
        $name = 'foo';
        
        $context = new Detect($name);
        
        $this->assertEquals($name, $this->getProperty('name', $context));
        
        return;
    }
    
    
    /* !__invoke() */ 
    
    /**
     * __invoke() should throw an exception if the variable is not set
     */
    public function testGetThrowsExceptionIfVariableIsNotSet()
    {
        $this->setExpectedException('RuntimeException');
        
        (new Detect('foo'))();
        
        return;
    }
    
    /**
     * __invoke() should return an environment if the variable is set
     */
    public function testGetReturnsEnvironmentIfVariableIsSet()
    {
        $name  = 'foo';
        $value = Environment::DEVELOPMENT;
        
        putenv("$name=$value");
        
        $this->assertEquals(new Environment($value), (new Detect($name))());
        
        return;
    }
}
