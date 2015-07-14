<?php

if (!function_exists('array_keys_extract')) {
    define('ARRAY_KEYS_EXTRACT_SKIP', 0);
    define('ARRAY_KEYS_EXTRACT_NULL', 1);
    define('ARRAY_KEYS_EXTRACT_EXCEPTION', 2);

    /**
     * array_keys_extract — Extract one or a set of values by key from an array
     *
     * @param string|array $keys
     * @param array        $array
     * @param integer      $options
     *
     * @return array
     */
    function array_keys_extract($keys, array $array, $options = ARRAY_KEYS_EXTRACT_SKIP)
    {
        $return = array();
        $keys = (array) $keys;

        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $return[$key] = $array[$key];

                continue;
            }

            switch ($options) {
                case ARRAY_KEYS_EXTRACT_NULL:
                    $return[$key] = null;
                    break;

                case ARRAY_KEYS_EXTRACT_EXCEPTION:
                    throw new \RuntimeException(sprintf('Key "%s" is not found in the array', $key));
                    break;

                case ARRAY_KEYS_EXTRACT_SKIP:
                default:
                    continue;
                    break;
            }
        }

        return $return;
    }
}
