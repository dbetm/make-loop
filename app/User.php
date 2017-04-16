<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @property integer $id
 * @property string $name
 * @property string $last_name
 * @property integer $points
 * @property string $email
 * @property string $password
 * @property boolean $is_active
 * @property integer $role
 * @property string $updated_at
 * @property string $image
 * @property string $country
 * @property string $state
 * @property string $bio
 * @property string $created_at
 * @property boolean $was_deleted
 */


class User extends Model implements Authenticatable {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'password', 'points', 'email',
        'is_active', 'image', 'country', 'state', 'bio'
    ];

    public function getAuthIdentifierName() {}

    public function getAuthIdentifier() {}

    public function getAuthPassword() {}

    public function getRememberToken() {}

    public function setRememberToken($val) {}

    public function getRememberTokenName() {}

}
