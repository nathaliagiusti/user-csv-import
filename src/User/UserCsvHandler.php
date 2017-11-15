<?php

namespace Api\User;

use Api\Validator\NameValidator;
use Api\Validator\PostCodeValidator;
use App\Repositories\Users;

class UserCsvHandler implements CsvHandlerInterface
{
    const LIMIT = 1000;

    /** @var array */
    private $users = [];

    /**
     * @param array $row
     */
    public function handleRow(array $row)
    {
        $name     = $row[0] ?? '';
        $postcode = $row[1] ?? '';

        if (!NameValidator::isValid($name) || !PostCodeValidator::isValid($postcode))
        {
            return;
        }

        // @todo : fix me. It does not set timestamps on these records, since uses query builder instead of eloquent.
        $this->users[] = [
            'name'     => $name,
            'postcode' => $postcode,
        ];

        if (count($this->users) >= self::LIMIT) {
            $this->saveUser();
            $this->users = [];
        }
    }

    public function onFinish()
    {
        $this->saveUser();
    }

    private function saveUser()
    {
        Users::save($this->users);
    }
}