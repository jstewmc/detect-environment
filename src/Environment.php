<?php
/**
 * The file for an application environment
 *
 * @author     Jack Clayton  <clayjs0@gmail.com>
 * @copyright  2016 Jack Clayton
 * @license    MIT
 */

namespace Jstewmc\DetectEnvironment;

/**
 * The application environment
 *
 * @since  0.1.0
 */
class Environment
{
    /* !Constants */
    
    /**
     * @var    string  the name of the development environment
     * @since  0.1.0
     */
    const DEVELOPMENT = 'development';
    
    /**
     * @var    string  the name of the production environment
     * @since  0.1.0
     */
    const PRODUCTION = 'production';
    
    /**
     * @var    string  the name of the staging environment
     * @since  0.1.0
     */
    const STAGING = 'staging';
    
    /**
     * @var    string  the name of the testing environment
     * @since  0.1.0
     */
    const TESTING = 'testing';
    
        
    /* !Private properties */
    
    /**
     * @var    string  the environment's name
     * @since  0.1.0
     */
    private $name;
    
    
    /* !Magic methods */
    
    /**
     * Called when the environment is constructed
     *
     * @param  string  $name  the environment's name
     * @since  0.1.0
     */
    public function __construct(string $name)
    {
        // define the valid environment names
        $names = [
            self::DEVELOPMENT,
            self::PRODUCTION,
            self::STAGING,
            self::TESTING
        ];
        
        // if the name is not valid, short-circuit
        if ( ! in_array($name, $names)) {
            throw new \InvalidArgumentException(
                __METHOD__ . "() expects parameter one, name, to be one of the "
                    . "following values: '" . implode("', '", $names) . "'; given "
                    . "'$name' "
            );
        }
        
        $this->name = $name;
    }
    
    
    /* !Get methods */
    
    /**
     * Returns the environment's name
     *
     * @return  string
     * @since   0.1.0
     */
    public function getName(): string
    {
        return $this->name;
    }
    
    
    /* !Public methods */
    
    /**
     * Returns true if the environment is development
     *
     * @return  bool
     * @since   0.1.0
     */
    public function isDevelopment(): bool
    {
        return $this->name === self::DEVELOPMENT;
    }   
    
    /**
     * Returns true if the environment is production
     *
     * @return  bool
     * @since   0.1.0
     */
    public function isProduction(): bool
    {
        return $this->name === self::PRODUCTION;
    }
    
    /**
     * Returns true if the environment is staging
     *
     * @return  bool
     * @since   0.1.0
     */
    public function isStaging(): bool
    {
        return $this->name === self::STAGING;
    }
    
    /**
     * Returns true if the environment is testing
     *
     * @return  bool
     * @since   0.1.0
     */
    public function isTesting(): bool
    {
        return $this->name === self::TESTING;
    }
}
