<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProdDataSeeder extends Seeder
{
    public const TENANT_EMAIL = 'root@dilamco.com';

    public const ADMIN_NAME = 'Admin';

    public const ADMIN_EMAIL = self::TENANT_EMAIL;

    public const ADMIN_PASSWORD = 'password';

    public function run()
    {
        DB::transaction(function () {
            $this->seedAdmin();
        });
    }

    protected function seedAdmin(): void
    {
        User::factory()->create([
            User::FIRST_NAME => self::ADMIN_NAME,
            User::EMAIL => self::ADMIN_EMAIL,
            User::PASSWORD => Hash::make(self::ADMIN_PASSWORD),
        ]);
    }
}
