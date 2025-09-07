<?php

namespace App\Filament\Pages;

use App\Rules\AdminLoginRule;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Filament\Schemas\Components\Component;

class CustomLogin extends Login
{
    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()
            ->rules([
                new AdminLoginRule(),
            ]);
    }
}
