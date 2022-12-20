<?php

namespace Tjslash\CtoSetImageTrait\Traits;

use Illuminate\Support\Str;
use Image;
use Storage;

trait SetImageTrait
{
    /**
     * Set image attribute
     *
     * @param ?string $value
     * @param ?string $key
     *
     * @return ?string
     */
    public function setImage($value, $key = 'image') : ?string
    {
        $options = $this->imageOptions[$key];
        $disk = Storage::disk($options['disk'] ?? 'public');

        // Empty value
        if ($value === null && $this->attributes[$key]) {
            $disk->delete($this->attributes[$key]);
            return null;
        }

        // Value is a base64
        if (Str::startsWith($value, 'data:image')) {
            $extension = explode('/', mime_content_type($value))[1];
            $image = Image::make($value)->encode($extension, 100);
            $filename = md5($value.time()) . '.' . $extension;
            $path = "{$options['destination_path']}/{$filename}";
            $disk->put($path, $image->stream());
            if ($this->attributes[$key]) {
                $disk->delete($this->attributes[$key]);
            }
            return Storage::url($path);
        }

        // Value is a string
        return $value;
    }
}