<?php

namespace MongoDBODMProxies\__PM__\App\Document\Consultation;

class Generatede4c6c6af5007ab72fd369da045db9784 extends \App\Document\Consultation implements \ProxyManager\Proxy\GhostObjectInterface
{
    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer07d37 = null;

    /**
     * @var bool tracks initialization status - true while the object is initializing
     */
    private $initializationTracker39c33 = false;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties84d12 = [
        
    ];

    /**
     * @var array[][] visibility and default value of defined properties, indexed by
     * property name and class name
     */
    private static $privateProperties8ed73 = [
        
    ];

    /**
     * @var string[][] declaring class name of defined protected properties, indexed by
     * property name
     */
    private static $protectedPropertiesdd4cc = [
        'animalId' => 'App\\Document\\Consultation',
        'count' => 'App\\Document\\Consultation',
    ];

    private static $signaturee4c6c6af5007ab72fd369da045db9784 = 'YTo0OntzOjk6ImNsYXNzTmFtZSI7czoyNToiQXBwXERvY3VtZW50XENvbnN1bHRhdGlvbiI7czo3OiJmYWN0b3J5IjtzOjQ0OiJQcm94eU1hbmFnZXJcRmFjdG9yeVxMYXp5TG9hZGluZ0dob3N0RmFjdG9yeSI7czoxOToicHJveHlNYW5hZ2VyVmVyc2lvbiI7czo0ODoidjEuMC4xOEAyYzhhNmNmZmMzMjIwZTk5MzUyYWQ5NThmZTdjZjA2YmY2Zjc2OTBmIjtzOjEyOiJwcm94eU9wdGlvbnMiO2E6MTp7czoxNzoic2tpcHBlZFByb3BlcnRpZXMiO2E6MTp7aTowO3M6NToiACoAaWQiO319fQ==';

    /**
     * Triggers initialization logic for this ghost object
     * 
     * @param string  $methodName
     * @param mixed[] $parameters
     * 
     * @return mixed
     */
    private function callInitializera359f($methodName, array $parameters)
    {
        if ($this->initializationTracker39c33 || ! $this->initializer07d37) {
            return;
        }
        
        $this->initializationTracker39c33 = true;
        
        $this->animalId = null;
        $this->count = 0;

        
        $properties = [
            '' . "\0" . '*' . "\0" . 'animalId' => & $this->animalId,
            '' . "\0" . '*' . "\0" . 'count' => & $this->count,
        ];

        
        
        $result = $this->initializer07d37->__invoke($this, $methodName, $parameters, $this->initializer07d37, $properties);
        $this->initializationTracker39c33 = false;
        
        return $result;
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        unset($instance->animalId, $instance->count);

        $instance->initializer07d37 = $initializer;

        return $instance;
    }

    public function & __get($name)
    {
        $this->initializer07d37 && ! $this->initializationTracker39c33 && $this->callInitializera359f('__get', array('name' => $name));
        
        if (isset(self::$publicProperties84d12[$name])) {
            return $this->$name;
        }
        
        if (isset(self::$protectedPropertiesdd4cc[$name])) {
            if ($this->initializationTracker39c33) {
                return $this->$name;
            }
        
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesdd4cc[$name];
        
            if ($object instanceof $expectedType) {
                return $this->$name;
            }
        
            $class = isset($caller['class']) ? $caller['class'] : '';
        
            if ($class === $expectedType || is_subclass_of($class, $expectedType) || $class === 'ReflectionProperty') {
                return $this->$name;
            }
        } elseif (isset(self::$privateProperties8ed73[$name])) {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';
        
            static $accessorCache = [];
        
            if (isset(self::$privateProperties8ed73[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function & ($instance) use ($name) {
                        return $instance->$name;
                    }, null, $class);
        
                return $accessor($this);
            }
        
            if ($this->initializationTracker39c33 || 'ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8ed73[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function & ($instance) use ($name) {
                        return $instance->$name;
                    }, null, $tmpClass);
        
                return $accessor($this);
            }
        }
        
        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer07d37 && $this->callInitializera359f('__set', array('name' => $name, 'value' => $value));
        
        if (isset(self::$publicProperties84d12[$name])) {
            return ($this->$name = $value);
        }
        
        if (isset(self::$protectedPropertiesdd4cc[$name])) {
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesdd4cc[$name];
        
            if ($object instanceof $expectedType) {
                return ($this->$name = $value);
            }
        
            $class = isset($caller['class']) ? $caller['class'] : '';
        
            if ($class === $expectedType || is_subclass_of($class, $expectedType) || $class === 'ReflectionProperty') {
                return ($this->$name = $value);
            }
        } elseif (isset(self::$privateProperties8ed73[$name])) {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';
        
            static $accessorCache = [];
        
            if (isset(self::$privateProperties8ed73[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance, $value) use ($name) {
                        return ($instance->$name = $value);
                    }, null, $class);
        
                return $accessor($this, $value);
            }
        
            if ('ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8ed73[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance, $value) use ($name) {
                        return ($instance->$name = $value);
                    }, null, $tmpClass);
        
                return $accessor($this, $value);
            }
        }
        
        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer07d37 && $this->callInitializera359f('__isset', array('name' => $name));
        
        if (isset(self::$publicProperties84d12[$name])) {
            return isset($this->$name);
        }
        
        if (isset(self::$protectedPropertiesdd4cc[$name])) {
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesdd4cc[$name];
        
            if ($object instanceof $expectedType) {
                return isset($this->$name);
            }
        
            $class = isset($caller['class']) ? $caller['class'] : '';
        
            if ($class === $expectedType || is_subclass_of($class, $expectedType)) {
                return isset($this->$name);
            }
        } else {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';
        
            static $accessorCache = [];
        
            if (isset(self::$privateProperties8ed73[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        return isset($instance->$name);
                    }, null, $class);
        
                return $accessor($this);
            }
        
            if ('ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8ed73[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        return isset($instance->$name);
                    }, null, $tmpClass);
        
                return $accessor($this);
            }
        }
        
        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            return isset($targetObject->$name);
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer07d37 && $this->callInitializera359f('__unset', array('name' => $name));
        
        if (isset(self::$publicProperties84d12[$name])) {
            unset($this->$name);
        
            return;
        }
        
        if (isset(self::$protectedPropertiesdd4cc[$name])) {
            // check protected property access via compatible class
            $callers      = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller       = isset($callers[1]) ? $callers[1] : [];
            $object       = isset($caller['object']) ? $caller['object'] : '';
            $expectedType = self::$protectedPropertiesdd4cc[$name];
        
            if ($object instanceof $expectedType) {
                unset($this->$name);
        
                return;
            }
        
            $class = isset($caller['class']) ? $caller['class'] : '';
        
            if ($class === $expectedType || is_subclass_of($class, $expectedType) || $class === 'ReflectionProperty') {
                unset($this->$name);
        
                return;
            }
        } elseif (isset(self::$privateProperties8ed73[$name])) {
            // check private property access via same class
            $callers = debug_backtrace(\DEBUG_BACKTRACE_PROVIDE_OBJECT, 2);
            $caller  = isset($callers[1]) ? $callers[1] : [];
            $class   = isset($caller['class']) ? $caller['class'] : '';
        
            static $accessorCache = [];
        
            if (isset(self::$privateProperties8ed73[$name][$class])) {
                $cacheKey = $class . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        unset($instance->$name);
                    }, null, $class);
        
                return $accessor($this);
            }
        
            if ('ReflectionProperty' === $class) {
                $tmpClass = key(self::$privateProperties8ed73[$name]);
                $cacheKey = $tmpClass . '#' . $name;
                $accessor = isset($accessorCache[$cacheKey])
                    ? $accessorCache[$cacheKey]
                    : $accessorCache[$cacheKey] = \Closure::bind(static function ($instance) use ($name) {
                        unset($instance->$name);
                    }, null, $tmpClass);
        
                return $accessor($this);
            }
        }
        
        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $realInstanceReflection->newInstanceWithoutConstructor();
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer07d37 && $this->callInitializera359f('__clone', []);
    }

    public function __sleep()
    {
        $this->initializer07d37 && $this->callInitializera359f('__sleep', []);

        return array_keys((array) $this);
    }

    public function setProxyInitializer(?\Closure $initializer = null) : void
    {
        $this->initializer07d37 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer07d37;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer07d37 && $this->callInitializera359f('initializeProxy', []);
    }

    public function isProxyInitialized() : bool
    {
        return ! $this->initializer07d37;
    }
}
