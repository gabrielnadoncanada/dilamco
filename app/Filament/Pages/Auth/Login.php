<?php

namespace App\Filament\Pages\Auth;

use Database\Seeders\ProdDataSeeder;
use Filament\Pages\Auth\Login as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => ProdDataSeeder::ADMIN_EMAIL,
            'password' => ProdDataSeeder::ADMIN_PASSWORD,
            'remember' => true,
        ]);
    }
}
