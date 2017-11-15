<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    const USER_POSTCODE = '1018AJ';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // @todo : create a database for test
        DB::table('users')->insert(self::getUsers());
    }

    /**
     * @return array
     */
    public static function getUsers() : array
    {
        return [
            [
                'name'     => 'Jaapy',
                'postcode' => self::USER_POSTCODE,
            ],
            [
                'name'     => 'Pieta',
                'postcode' => self::USER_POSTCODE,
            ],
            [
                'name'     => 'Klaas',
                'postcode' => self::USER_POSTCODE,
            ],
            [
                'name'     => 'Petrax',
                'postcode' => '1111AB',
            ]
        ];
    }
}
