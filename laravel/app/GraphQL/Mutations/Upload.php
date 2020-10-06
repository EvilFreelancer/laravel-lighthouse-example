<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;
use GraphQL\Error\Error;

class Upload
{
    /**
     * Upload user's image and save to storage
     *
     * @param null                 $_
     * @param array<string, mixed> $args
     *
     * @return \App\Models\Image
     * @throws \GraphQL\Error\Error
     */
    public function __invoke($_, array $args)
    {
        $validator = \Validator::make($args, [
            'file' => 'required|image'
        ]);

        if($validator->fails()) {
            throw new Error('Invalid image');
        }

        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];

        // $this->user_id
        \Storage::put(Image::getPathOfImage(null, null), $file);

        $image       = new Image();
        $image->name = $file->getFilename();
        $image->hash = $file->hashName();
        // $image->user_id =
        $image->save();

        return $image;
    }
}
