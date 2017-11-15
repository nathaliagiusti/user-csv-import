<?php

class UserControllerTest extends TestCase
{
    public function testGetUsersByPostCodeShouldNotReturnUsersWithDifferentPostCode()
    {
        $this->artisan("db:seed");

        $jsonStructure = [
            '*' => [
                'name',
                'postcode'
            ]
        ];

        $this->get('/user?postcode=' . DatabaseSeeder::USER_POSTCODE)
            ->seeJsonStructure($jsonStructure)
            ->seeJsonContains(['postcode' => DatabaseSeeder::USER_POSTCODE])
            ->dontSeeJson([
                'name'     => 'Petrax',
                'postcode' => '1111AB',
            ]);
    }
}
