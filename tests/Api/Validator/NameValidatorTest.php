<?php

use Api\Validator\NameValidator;
use PHPUnit\Framework\TestCase;

class NameValidatorTest extends TestCase
{
    /**
     * @dataProvider nameProvider
     *
     * @param string $name
     * @param bool   $expectedResult
     */
    public function testIsValidShouldReturnExpectedResult(string $name, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, NameValidator::isValid($name));
    }

    /**
     * @return array
     */
    public function nameProvider()
    {
        return [
            'valid name'   => ['Isaac Newton', true],
            'invalid name' => ['AnyName ! Surname', false],
            'empty string' => ['', false],
        ];
    }
}
