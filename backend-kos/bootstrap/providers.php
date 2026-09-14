<?php

use App\Providers\AppServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\Filament\OwnerPanelProvider;

return [
    AppServiceProvider::class,
    FortifyServiceProvider::class,
    OwnerPanelProvider::class,
];
