<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait PasswordAttribute
{
    /**
     * BCRYPT password.
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) => bcrypt($value)
        );
    }
}
