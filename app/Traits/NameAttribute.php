<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait NameAttribute
{
    /**
     * SET name.
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function name(): Attribute
    {
        return new Attribute(
            set: fn ($value) => ucwords($value)
        );
    }
}
