<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Image extends Model
{
    public static function getPathOfImage(string $filename = null, string $user_id = null): string
    {
        $patch = null;
        if (null !== $user_id) {
            $patch = $user_id . '/';
        }

        return 'uploads/' . $patch . $filename;
    }

    /**
     * @example http://localhost/uploads/1/saldfhaskjdhflasd.jpg
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return \Asset($this->getPathOfImage($this->hash, $this->user_id));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
