<?php

use Illuminate\Support\Facades\Log;

if (! function_exists('attempt')) {
    /**
     * Attempts to execute a callback and returns its result or null on failure. Optionally logs errors.
     * Example: $result = attempt(function () { return 2 * 3; }); // Returns 6
     *
     * @param  callable  $callback The callback to execute.
     * @param  bool  $log Whether to log errors or not.
     * @return mixed|null The result of the callback or null on failure.
     */
    function attempt(callable $callback, bool $log = true): mixed
    {
        try {
            return $callback();
        } catch (Exception $e) {
            if ($log) {
                Log::error('Failed attempt', ['error' => $e]);
            }

            return null;
        }
    }
}

if (! function_exists('get_type')) {
    function get_type(mixed $value): string
    {
        return gettype($value);
    }
}

if (! function_exists('get_type_and_class')) {
    function get_type_and_class(mixed $value): array
    {
        $type = get_type($value);

        if ($type === 'object') {
            $class = get_class($value);
        }

        return [$type, $class ?? null];
    }
}

if (! function_exists('starts_with')) {
    /**
     * Checks if `$haystack` starts with any of the `$needles`.
     * Example: $check = starts_with('hello world', ['he', 'wo']); // Returns true
     *
     * @param  string  $haystack The string to search in.
     * @param  array  $needles The strings to search for.
     * @return bool True if `$haystack` starts with any of the `$needles`, false otherwise.
     */
    function starts_with(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_starts_with($haystack, $needle)) {
                return true;
            }
        }

        return false;
    }
}
