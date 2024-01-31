<?php

use Illuminate\Support\Arr;

if (! function_exists('array_find')) {
    /**
     * Searches an array for an item where `$field` equals `$value` and returns the first match.
     * Example: $found = array_find([['name' => 'Alice'], ['name' => 'Bob']], 'name', 'Alice'); // Returns ['name' => 'Alice']
     *
     * @param  array  $array The array to search through.
     * @param mixed $field The field to search for.
     * @param mixed $value The value to search for.
     * @return mixed|null The found item or null.
     */
    function array_find(array $array, mixed $field, mixed $value): mixed
    {
        return array_reduce($array, static function ($carry, $item) use ($field, $value) {
            return $carry ?: (isset($item[$field]) && $item[$field] === $value ? $item : null);
        });
    }
}

if (! function_exists('array_flatten')) {
    /**
     * Flattens a multidimensional array into a single level array.
     * Example: $flat = array_flatten([[1, 2], [3, 4]]); // Returns [1, 2, 3, 4]
     *
     * @param  array  $array The array to flatten.
     * @return array The flattened array.
     */
    function array_flatten(array $array): array
    {
        $return = [];
        array_walk_recursive($array, static function ($value) use (&$return) {
            $return[] = $value;
        });

        return $return;
    }
}

if (! function_exists('array_key_map')) {
    /**
     * Retrieves the value associated with `$key` from a multidimensional array.
     * Example: $name = array_key_map(['user' => ['name' => 'Alice', 'age' => 30]], 'name'); // Returns 'Alice'
     *
     * @param  array  $array The array to search through.
     * @param mixed $key The key to search for.
     * @return mixed The value associated with `$key` or the mapped array.
     */
    function array_key_map(array $array, mixed $key): mixed
    {
        return in_array($key, array_keys($array))
            ? $array[$key]
            : array_map(function ($array) use ($key) {
                return array_key_map($array, $key);
            }, $array);
    }
}

if (! function_exists('array_key_prefix')) {
    /**
     * Adds a prefix to each key in an array.
     * Example: $prefixed = array_key_prefix(['name' => 'Alice'], 'user_'); // Returns ['user_name' => 'Alice']
     *
     * @param  array  $array The array whose keys are to be prefixed.
     * @param  string  $prefix The prefix to add to each key.
     * @return array The array with prefixed keys.
     */
    function array_key_prefix(array $array, string $prefix): array
    {
        return array_combine(
            array_map(static function ($key) use ($prefix) {
                return $prefix.$key;
            },
                array_keys($array)
            ),
            $array
        );
    }
}

if (! function_exists('array_remove')) {
    /**
     * Removes an item from an array by key and returns its value.
     * Example: $age = array_remove(['name' => 'Alice', 'age' => 30], 'age'); // $data is now ['name' => 'Alice']
     *
     * @param  array  $array The array to modify.
     * @param mixed $key The key of the item to remove.
     * @return mixed|null The value of the removed item or null.
     */
    function array_remove(array &$array, mixed $key): mixed
    {
        $value = $array[$key] ?? null;
        unset($array[$key]);

        return $value;
    }
}

if (! function_exists('array_wrap')) {
    /**
     * Wraps a given value in an array if it is not already one.
     * Example: $wrapped = array_wrap('Alice'); // Returns ['Alice']
     *
     * @param mixed $value The value to wrap.
     * @return array The wrapped value.
     */
    function array_wrap(mixed $value): array
    {
        return Arr::wrap($value);
    }
}

if (! function_exists('pop')) {
    /**
     * Pops and returns the last value of the array, reducing the array by one element.
     * Example: $last = pop([1, 2, 3]); // Returns 3, $numbers is now [1, 2]
     *
     * @param  array  $array The array to pop the value from.
     * @return mixed The popped value.
     */
    function pop(array $array): mixed
    {
        return array_pop($array);
    }
}

if (! function_exists('shift')) {
    /**
     * Shifts and returns the first value of the array after reversing it.
     * Example: $first = shift([1, 2, 3]); // Returns 1
     *
     * @param  array  $array The array to shift the value from.
     * @return mixed The shifted value.
     */
    function shift(array $array): mixed
    {
        $array = array_reverse($array);

        return pop($array);
    }
}
