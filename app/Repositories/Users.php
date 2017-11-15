<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Users
{
    const USERS_TABLE = 'users';

    /**
     * @param string $postCode
     * @param int    $limit
     * @param int    $offset
     *
     * @return Collection
     */
    public static function getByPostCode(string $postCode, int $limit, int $offset) : Collection
    {
        return DB::table(self::USERS_TABLE)
            ->select('name', 'postcode')
            ->where('postcode', $postCode)
            ->limit($limit)
            ->offset($offset)
            ->get();
    }

    /**
     * @param array $users
     */
    public static function save(array $users)
    {
        DB::table(self::USERS_TABLE)->insert($users);
    }
}