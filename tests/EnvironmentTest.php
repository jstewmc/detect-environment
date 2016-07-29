<?php
/**
 * The file for the environment tests
 *
 * @author     Jack Clayton <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\DetectEnvironment;

use Jstewmc\TestCase\TestCase;

/**
 * Tests for the environment data object
 */
class EvironmentTest extends TestCase
{
    /* !__construct() */
    
    /**
     * __construct() should throw exception if name is invalid
     */
    public function testConstructThrowsExceptionIfNameIsNotvalid()
    {
        $this->setExpectedException('InvalidArgumentException');
        
        new Environment('foo');
        
        return;
    }
    
    /**
     * __construct() should set the environment's name
     */
    public function testConstructIfNameIsValid()
    {
        $name = Environment::DEVELOPMENT;
        
        $env = new Environment($name);
        
        $this->assertEquals($name, $this->getProperty('name', $env));
        
        return;
    }
    
    
    /* !getName() */
    
    /**
     * getName() should return string
     */
    public function testGetName()
    {
        $name = Environment::DEVELOPMENT;
        
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, $name);
        
        $this->assertSame($name, $env->getName());
        
        return;
    }
    
    
    /* !isDevelopment() */
    
    /**
     * isDevelopment() should return false if the environment is not development
     */
    public function testIsDevelopmentReturnsFalseIfNotDevelopment()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::STAGING);
        
        $this->assertFalse($env->isDevelopment());
        
        return;
    }
    
    /**
     * isDevelopment() should return true if the environment is development
     */
    public function testIsDevelopmentReturnsTrueIfDevelopment()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::DEVELOPMENT);
        
        $this->assertTrue($env->isDevelopment());
        
        return;
    }
    
    
    /* !isProduction() */
    
    /**
     * isProduction() should return false if the environment is not production
     */
    public function testIsProductionReturnsFalseIfNotProduction()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::STAGING);
        
        $this->assertFalse($env->isProduction());
        
        return;
    }
    
    /**
     * isProduction() should return true if the environment is production
     */
    public function testIsProductionReturnsTrueIfProduction()
    {
        $env = new Environment(Environment::STAGING);
    
        $this->setProperty('name', $env, Environment::PRODUCTION);
        
        $this->assertTrue($env->isProduction());
        
        return;
    }
    
    
    /* !isStaging() */
    
    /**
     * isStaging() should return false if the environment is not staging
     */
    public function testIsStagingReturnsFalseIfNotStaging()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::DEVELOPMENT);
        
        $this->assertFalse($env->isStaging());
        
        return;
    }
    
    /**
     * isStaging() should return true if the environment is staging
     */
    public function testIsStagingReturnsTrueIfStaging()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::STAGING);
        
        $this->assertTrue($env->isStaging());
        
        return;
    }
    
    
    /* !isTesting() */
    
    /**
     * isTesting() should return false if the environment is not testing
     */
    public function testIsTestingReturnsFalseIfNotTesting()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::STAGING);
        
        $this->assertFalse($env->isTesting());
        
        return;
    }
    
    /**
     * isTesting() should return true if the environment is testing
     */
    public function testIsTestingReturnsTrueIfTesting()
    {
        $env = new Environment(Environment::STAGING);
        
        $this->setProperty('name', $env, Environment::TESTING);
        
        $this->assertTrue($env->isTesting());
        
        return;
    }
}
