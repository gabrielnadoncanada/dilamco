<?php

namespace App\Models;

use App\Traits\CanGetNamesStatically;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasAvatar, HasName
{
    use CanGetNamesStatically, HasFactory, Notifiable, SoftDeletes;

    public const ID = 'id';

    public const FIRST_NAME = 'first_name';

    public const LAST_NAME = 'last_name';

    public const NOTE = 'note';

    public const PHONE = 'phone';

    public const NAME = 'name';

    public const EMAIL = 'email';

    public const PASSWORD = 'password';

    public const REMEMBER_TOKEN = 'remember_token';

    public const EMAIL_VERIFIED_AT = 'email_verified_at';

    protected $guarded = [

    ];

    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    protected function casts(): array
    {
        return [
            self::EMAIL_VERIFIED_AT => 'datetime',
            self::PASSWORD => 'hashed',
        ];
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return null;
    }

    public function getFilamentName(): string
    {
        return "$this->first_name $this->last_name";
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->first_name.' '.$this->last_name
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
}
