<?php

namespace Domain\Validator;

use Exception;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

trait TraitValidator
{
    private ?ReflectionClass $reflectionClass = null;

    private function getReflectionClass(): ReflectionClass
    {
        if (!$this->reflectionClass) {
            $this->reflectionClass = new ReflectionClass($this);
        }

        return $this->reflectionClass;
    }
    protected function check(): void
    {
        foreach ($this->getReflectionClass()->getProperties() as $property) {
            if ($property->getModifiers() == 132){
                if (!\Respect\Validation\Validator::{$property->getName()}()->validate($this->{$property->getName()})) {
                    throw new \InvalidArgumentException("{$property->getName()} is one {$this->{$property->getName()}} invalid.");
                }
            }
        }
    }

    public function __set(string $name, $value): void
    {
        if (!$property = $this->getProperty($name)) {
            return;
        }

        foreach ($property->getAttributes() as $attribute) {
            if ($attribute->getName() == Validator::class) {
                foreach ($attribute->getArguments() as $argument){
                    if (!\Respect\Validation\Validator::$argument()->validate($value)) {
                        throw new \InvalidArgumentException("$name is one $argument invalid.");
                    }
                }

                $this->$name = $value;
            }
        }
    }

    public function __get(string $name): mixed
    {
        if (!$this->getProperty($name)) {
            throw new Exception('The property not exists.');
        }

        return $this->$name;
    }

    private function getProperty(string $name): ?ReflectionProperty
    {
        try {
            $reflaction = new ReflectionClass($this);
            return $reflaction->getProperty($name);
        } catch (ReflectionException $e){
            return null;
        }
    }
}