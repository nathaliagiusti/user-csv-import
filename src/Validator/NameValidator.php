<?php

namespace Api\Validator;

class NameValidator
{
    const NAME_REGEX = '/^[a-z\s]*$/i';

    /**
     * @param string $name
     *
     * @return bool
     */
    public static function isValid(string $name): bool
    {
        return !empty($name)
            && preg_match(self::NAME_REGEX, $name);
    }
}