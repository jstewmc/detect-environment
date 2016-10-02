<?php
/**
 * The file for the detect-environment service tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\DetectEnvironment;

use Jstewmc\TestCase\TestCase;

/**
 * Tests for the detect-environment service
 */
class DetectEnvironmentTest extends TestCase
{
    /* !Private properties */
    
    /**
     * @var  string  the name of the environment variable
     */
    private $name = 'foo';
    
    /**
     * @var  string  the value of the environment variable
     */
    private $value = 'development';
    
    
    /* !Framework methods */
    
    /**
     * Called before every test
     *
     * @return  void
     */
    public function setUp()
    {
        putenv("{$this->name}={$this->value}");
        
        return;
    }
    
    
    /* !__call() */
    
    /**
     * __call() should throw an exception if the method name is invalid
     */
    public function testCallThrowsExceptionIfMethodIsInvalid()
    {
        $this->setExpectedException('BadMethodCallException');
        
        // method name must start with "is"
        (new DetectEnvironment($this->name, []))->foo();
        
        return;
    }
    
    /**
     * __call() should throw an exception if the environment name is invalid
     */
    public function testCallThrowsExceptionIfEnvironmentIsInvalid()
    {
        $this->setExpectedException('OutOfBoundsException');
        
        // method name must be defined in possible values array
        (new DetectEnvironment($this->name, []))->isDevelopment();
        
        return;
    }
    
    /**
     * __call() should return false if the environments do not match
     */
    public function testCallReturnsFalseIfEnvironmentsDoNotMatch()
    {
        // define the possible values
        $values = [
            'foo' => $this->value,
            'bar' => strrev($this->value)
        ];
        
        $this->assertFalse((new DetectEnvironment($this->name, $values))->isBar());
        
        return;
    }
    
    /**
     * __call() should return true if the environments do match
     */
    public function testCallReturnsTrieIfEnvironmentsDoMatch()
    {
        // define the possible values
        $values = [
            'foo' => $this->value,
            'bar' => strrev($this->value)
        ];
        
        $this->assertTrue((new DetectEnvironment($this->name, $values))->isFoo());
        
        return;
    }
    
    
    /* !__construct() */
    
    /**
     * __construct() should throw an exception if the variable is not defined
     */
    public function testConstructThrowsExceptionIfVariableIsNotDefined()
    {
        $this->setExpectedException('OutOfBoundsException');
        
        // set the environment variable's name to *anything* but the name used in
        //     the setUp() method
        //
        (new DetectEnvironment(strrev($this->name), []))();
        
        return;
    }
    
    /**
     * __construct() should set the properties if the variable is defined
     */
    public function testConstructSetsPropertiesIfVariableIsDefined()
    {
        $values = [
            'development' => $this->value,
            'testing'     => strrev($this->value)
        ];
        
        $service = new DetectEnvironment($this->name, $values);
        
        $this->assertEquals($this->value, $this->getProperty('actualValue', $service));
        $this->assertEquals($values, $this->getProperty('possibleValues', $service));
        
        return;
    }
    
    
    /* !__invoke() */
    
    /**
     * __invoke() should return string
     */
    public function testInvoke()
    {
        return $this->assertEquals(
            $this->value, 
            (new DetectEnvironment($this->name, []))()
        );
    }
}
