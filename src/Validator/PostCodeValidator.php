<?php

namespace Api\Validator;

class PostCodeValidator
{
    const POSTCODE_REGEX = '/[0-9]{4}[A-Z]{2}/i';

    /**
     * @param string $postcode
     *
     * @return bool
     */
    public static function isValid(string $postcode): bool
    {
        return strlen($postcode) == 6
            && preg_match(self::POSTCODE_REGEX, $postcode);
    }
}