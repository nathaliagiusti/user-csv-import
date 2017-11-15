<?php

use Api\Validator\PostCodeValidator;
use PHPUnit\Framework\TestCase;

class PostCodeValidatorTest extends TestCase
{
    /**
     * @dataProvider postCodeProvider
     *
     * @param string $postCode
     * @param bool   $expectedResult
     */
    public function testIsValidShouldReturnExpectedResult(string $postCode, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, PostCodeValidator::isValid($postCode));
    }

    /**
     * @return array
     */
    public function postCodeProvider()
    {
        return [
            'valid post code'    => ['1010AH', true],
            'invalid post code'  => ['!!!!AH', false],
            'missing one letter' => ['1111H', false],
            'empty string'       => ['', false],
        ];
    }
}
