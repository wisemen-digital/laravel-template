<?php

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
