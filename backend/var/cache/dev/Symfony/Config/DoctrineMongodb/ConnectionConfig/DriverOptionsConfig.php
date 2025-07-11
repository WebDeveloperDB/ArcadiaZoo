<?php

namespace Symfony\Config\DoctrineMongodb\ConnectionConfig;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class DriverOptionsConfig 
{
    private $context;
    private $_usedProperties = [];
    
    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function context($value): static
    {
        $this->_usedProperties['context'] = true;
        $this->context = $value;
    
        return $this;
    }
    
    public function __construct(array $value = [])
    {
        if (array_key_exists('context', $value)) {
            $this->_usedProperties['context'] = true;
            $this->context = $value['context'];
            unset($value['context']);
        }
    
        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }
    
    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['context'])) {
            $output['context'] = $this->context;
        }
    
        return $output;
    }

}
