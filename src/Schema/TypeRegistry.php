<?php

namespace Nuwave\Lighthouse\Schema;

use GraphQL\Type\Definition\Type;
use GraphQL\Error\InvariantViolation;

/**
 * Store the executable types of our GraphQL schema.
 *
 * Class TypeRegistry
 */
class TypeRegistry
{
    /**
     * A map of executable schema types by name.
     *
     * [$typeName => Type]
     *
     * @var Type[]
     */
    protected $types;

    /**
     * Register type with registry.
     *
     * @param Type $type
     *
     * @return TypeRegistry
     */
    public function register(Type $type): self
    {
        $this->types[$type->name] = $type;

        return $this;
    }

    /**
     * Resolve type instance by name.
     *
     * @param string $typeName
     *
     * @throws InvariantViolation
     *
     * @return Type
     */
    public function get(string $typeName): Type
    {
        if (! isset($this->types[$typeName])) {
            throw new InvariantViolation("No type {$typeName} was registered.");
        }

        return $this->types[$typeName];
    }
}
