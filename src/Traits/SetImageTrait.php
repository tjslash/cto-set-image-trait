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
     * @param ?string $attribute_name
     *
     * @return ?string
     */
    public function setImage(?string $value, ?string $attribute_name = 'image') : ?string
    {
        $options = $this->imageOptions[$attribute_name];
        $disk = Storage::disk($options['disk'] ?? 'public');

        // Empty value
        if ($value === null && $this->{$attribute_name}) {
            $disk->delete($this->{$attribute_name});
            return null;
        }

        // Value is a base64
        if (Str::startsWith($value, 'data:image')) {
            $extension = explode('/', mime_content_type($value))[1];
            $image = Image::make($value)->encode($extension, 100);
            $filename = md5($value.time()) . '.' . $extension;
            $path = "{$options['destination_path']}/{$filename}";
            $disk->put($path, $image->stream());
            if ($this->{$attribute_name}) {
                $disk->delete($this->{$attribute_name});
            }
            return Storage::url($path);
        }

        // Value is a string
        return $value;
    }
}