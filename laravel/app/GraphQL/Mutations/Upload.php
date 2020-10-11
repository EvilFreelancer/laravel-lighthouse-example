<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;

class Upload
{
    /**
     * Upload user's image and save to storage
     *
     * @param null                 $_
     * @param array<string, mixed> $args
     *
     * @return \App\Models\Image
     */
    public function __invoke($_, array $args)
    {
        /** @var \App\User $user */
        $user = \Auth::guard()->user();

        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];

        \Storage::put(Image::getPathOfImage(null, $user->id), $file);

        $image          = new Image();
        $image->name    = $file->getFilename();
        $image->hash    = $file->hashName();
        $image->user_id = $user->id;
        $image->save();

        return $image;
    }
}
