<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait UsesUuid
{
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            $model->setUuid();
        });
    }

    public function setUuid()
    {
        if (! $this->getKey()) {
            $this->{$this->getKeyName()} = $this->generateUuid();
        }
    }

    /**
     * @return string
     */
    public static function generateUuid()
    {
        return (string) Str::orderedUuid();
    }

    /**
     * @return false
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
