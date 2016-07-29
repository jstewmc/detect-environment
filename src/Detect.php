<?php
/**
 * The file for the detect-environment context
 *
 * @author     Jack Clayton  <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\DetectEnvironment;

use RuntimeException;

/**
 * The detect-environment context
 *
 * I'll detect the application's environment based on a sever environment variable.
 *
 * @since  0.1.0
 */
class Detect
{
    /* !Private properties */
    
    /**
     * @var    string  the environment variable's name
     * @since  0.1.0
     */
    private $name;
    
    
    /* !Magic methods */
    
    /**
     * Called when the context is constructed
     *
     * @param   string  $name  the environment-variable's name
     * @since   0.1.0
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    } 
    
    /**
     * Returns the application's environment
     *
     * @return  Environment
     * @throws  RuntimeException  if the environment variable is not defined
     * @since   0.1.0
     */
    public function __invoke(): Environment
    {
        // if the environment variable is not defined, short-circuit
        if (false === ($value = getenv($this->name))) {
            throw new RuntimeException(
                __METHOD__ . "() expects the environment variable "
                    . "'{$this->name}' to be defined"
            );
        }
        
        return new Environment($value); 
    }
}
