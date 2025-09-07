<?php

namespace App\Filament\Pages;

use App\Rules\AdminLoginRule;
use Filament\Auth\Pages\Login;
use Filament\Schemas\Components\Component;

class CustomLogin extends Login
{
    protected function getEmailFormComponent(): Component
    {
        return parent::getEmailFormComponent()
            ->rules([
                new AdminLoginRule,
            ]);
    }
}
