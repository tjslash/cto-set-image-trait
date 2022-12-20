# Set Image Trait

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![The Whole Fruit Manifesto](https://img.shields.io/badge/writing%20standard-the%20whole%20fruit-brightgreen)](https://github.com/the-whole-fruit/manifesto)

This package for set attribute images field for Laravel Eloquent models.

## Installation

Via Composer

``` bash
composer require tjslash/cto-set-image-trait
```

## Usage

```php
namespace App\Models;
use Tjslash\CtoSetImageTrait\Traits\SetImageTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
...

class SimpleModel extends Model 
{
    use SetImageTrait;
    
    /**
     * Image options
     * 
     * @return array
     */
    protected $imageOptions = [
        'image' => [
            'destination_path' => 'category',
            'disk' => 'public'
        ]
    ];
    
    /**
     * Get/set image attribute
     * 
     * @return Attribute
     */
    public function image() : Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: fn($value) => self::setImage($value, 'image')
        );
    }
    
    ...
}
```

## Change log

Changes are documented here on Github. Please see the [Releases tab](https://github.com/tjslash/cto-set-image-trait/releases).

## Testing

``` bash
composer test
```

## Contributing

Please see [contributing.md](contributing.md) for a todolist and howtos.

## Security

If you discover any security related issues, please email vakylenkox@gmail.com instead of using the issue tracker.

## Credits

- [Artem Vakylenko][link-author]
- [All Contributors][link-contributors]

## License

This project was released under MIT, so you can install it on top of any Backpack & Laravel project. Please see the [license file](license.md) for more information. 

[ico-version]: https://img.shields.io/packagist/v/tjslash/cto-set-image-trait.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tjslash/cto-set-image-trait.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tjslash/cto-set-image-trait
[link-downloads]: https://packagist.org/packages/tjslash/cto-set-image-trait
[link-author]: https://github.com/tjslash
[link-contributors]: ../../contributors
