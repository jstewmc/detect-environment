<?php
/**
 * The file for the detect-environment service
 *
 * @author     Jack Clayton  <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\DetectEnvironment;

use BadMethodCallException;
use OutOfBoundsException;

/**
 * The detect-environment service
 *
 * I'll detect the application's environment (e.g., "development", "testing", etc)
 * from a sever-side environment variable (e.g., "APPLICATION_ENVIRONMENT").
 *
 * @since  0.1.0
 * @since  0.2.0  refactor to support user-defined environments
 */
class Detect
{
    /* !Private properties */
    
    /**
     * @var    string  the *actual* value of the server-side environment variable
     * @since  0.2.0
     */
    private $actualValue;
    
    /**
     * @var    mixed[]  the *possible* values of the server-side environment variable
     *     indexed by the environment's name (e.g., ["development" => "dev", ...])
     * @since  0.2.0
     */
    private $possibleValues = [];
    
    
    /* !Magic methods */
    
    /**
     * Called when an inaccessible method is invoked
     *
     * I handle "isX" methods, where "X" is an environment name. If the application
     * is in the environment, I'll return true. If not, I'll return false. If the
     * environment name is not value, I'll throw an OutOfBoundsException.
     *
     * @param   string   $name       the invoked method's name
     * @param   mixed[]  $arguments  the invoked method's arguments (optional)
     * @return  bool
     * @throws  BadMethodCallException  if the invoked method name does not start 
     *     with "is" (e.g., "isDevelopment")
     * @throws  OutOfBoundsException    if the environment name is not defined
     *     (e.g., "isFoo" where "foo" is not a valid environment name)
     * @since   0.2.0
     */
    public function __call(string $name, array $arguments = []): bool
    {
        // if the method name doesn't start with "is", short-circuit
        if (strtolower(substr($name, 0, 2)) !== 'is') {
            throw new BadMethodCallException(
                "Call to undefined method " . __CLASS__ . "::{$name}"
            );
        }
        
        // otherwise, get the environment name from the method name
        // e.g., "isDevelopment" -> "development"
        //
        $environment = strtolower(substr($name, 2));
        
        // if the environment name does not exist, short-circuit
        if ( ! array_key_exists($environment, $this->possibleValues)) {
            throw new OutOfBoundsException(
                __METHOD__ . "() expects the environment, '{$environment}', to be "
                    . "defined as an index in the service's possible values array"
            );
        }
        
        // otherwise, determine if the value of the server-side environment variable 
        //     matches the value of the named environment
        //
        $isEnv = $this->possibleValues[$environment] === $this->actualValue; 
        
        return $isEnv;
    }
    
    /**
     * Called when the context is constructed
     *
     * @param   string    $name  the name of the servier-side environment variable
     *     (e.g., "APPLICATION_ENVIRONMENT")
     * @param   string[]  $possibleValues  the *possible* values of the server-side
     *     environment variable indexed by environment name (case-insensitive)
     * @throws  OutOfBoundsException  if the server-side environment variable is
     *     not defined
     * @since   0.1.0
     * @since   0.2.0  refactor to support user-defined environments
     */
    public function __construct(string $name, array $possibleValues)
    {
        // if the environment variable is not defined, short-circuit
        if (false === ($actualValue = getenv($name))) {
            throw new OutOfBoundsException(
                __METHOD__ . "() expects the server-side environment variable "
                    . "'{$name}' to be defined"
            );
        }
        
        // otherwise, set the *actual* value
        $this->actualValue = strtolower($actualValue);
        
        // set the lower-case *possible* values
        foreach ($possibleValues as $environment => $value) {
            $this->possibleValues[strtolower($environment)] = strtolower($value);
        }
    } 
    
    /**
     * Called when the service is treated like a function
     *
     * @return  string
     * @since   2.0.0
     */
    public function __invoke(): string
    {
        return $this->actualValue;
    }
}
