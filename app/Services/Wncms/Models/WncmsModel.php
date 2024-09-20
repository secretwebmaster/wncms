<?php

namespace App\Services\Wncms\Models;

use Illuminate\Database\Eloquent\Model;

class WncmsModel extends Model
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (array_key_exists($key, $this->attributes)) {
            event('model.getting.attribute', [$this, $key, &$value]);
        }

        return $value;
    }
}