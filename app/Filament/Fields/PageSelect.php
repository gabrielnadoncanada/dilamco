<?php

namespace App\Filament\Fields;

use App\Models\Single;
use Filament\Forms\Components\Select;

class PageSelect extends Select
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->options(fn () => Single::all()->pluck('title', 'id')->toArray());
    }
}
