<?php

namespace App\Enums\Traits;

use Exception;
use InvalidArgumentException;

trait IsExtendedEnum
{
    /**
     * Get the names of the enum cases.
     *
     * @param  mixed  ...$cases
     * @return array
     * @throws Exception
     */
    public static function names(...$cases): array
    {
        $cases = self::validate($cases);

        return array_map(static function ($case) {
            return $case->name;
        }, $cases);
    }

    /**
     * Check if a name exists in the enum cases.
     *
     * @param  string  $name
     * @param  bool  $strict
     * @return bool
     * @throws Exception
     */
    public static function hasName(string $name, bool $strict = false): bool
    {
        return in_array($name, self::names(), $strict);
    }

    /**
     * Get the values of the enum cases.
     *
     * @param  mixed  ...$cases
     * @return array
     * @throws Exception
     */
    public static function values(...$cases): array
    {
        $cases = self::validate($cases);

        return array_map(static function ($case) {
            return $case->value ?? $case->name;
        }, $cases);
    }

    /**
     * Check if a value exists in the enum cases.
     *
     * @param  string  $value
     * @return bool
     * @throws Exception
     */
    public static function hasValue(string $value): bool
    {
        return in_array($value, self::values(), true);
    }

    /**
     * Get options of the enum cases.
     *
     * @param  mixed  ...$cases
     * @return array
     * @throws Exception
     */
    public static function options(...$cases): array
    {
        $cases = self::validate($cases);

        return array_combine(self::names($cases), self::values($cases));
    }

    /**
     * Check if the enum instance equals any of the provided cases.
     *
     * @param  mixed  ...$cases
     * @return bool
     * @throws Exception
     */
    public function equals(...$cases): bool
    {
        $value = $this->value ?? $this->name;

        $values = self::values($cases);

        return $cases && in_array($value, $values, true);
    }

    /**
     * Magic method for static calls.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws Exception|InvalidArgumentException
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $options = self::options();

        if (array_key_exists($name, $options)) {
            return $options[$name];
        }

        throw new InvalidArgumentException('Undefined constant ' . self::class . '::' . $name);
    }

    /**
     * Validate and flatten the provided cases.
     *
     * @param mixed $cases
     * @return array
     * @throws InvalidArgumentException
     */
    private static function validate(mixed $cases): array
    {
        $cases = array_flatten($cases);

        if ($filter = array_filter($cases, static function ($case) {
            return ! ($case instanceof self);
        })) {
            [$type, $class] = get_type_and_class(shift($filter));

            throw new InvalidArgumentException('Arguments must be of type ' . self::class . ', ' . ($class ?? $type) . ' given');
        }

        return $cases ?: self::cases();
    }
}
