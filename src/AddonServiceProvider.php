<?php

namespace Tjslash\CtoSetImageTrait;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    use AutomaticServiceProvider;

    protected $vendorName = 'tjslash';
    protected $packageName = 'cto-set-image-trait';
    protected $commands = [];
}
