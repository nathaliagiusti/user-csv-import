<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /** @inheritdoc */
    public $timestamps = true;

    /** @inheritdoc */
    protected $table = 'users';

    /** @inheritdoc */
    protected $fillable = [
        'name',
        'postcode',
    ];
}