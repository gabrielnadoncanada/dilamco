<?php

namespace App\Enums;

use App\Traits\HasRandomEnum;
use App\Traits\HasTranslatableLabel;
use Filament\Support\Contracts\HasLabel;

enum PermalinkType: string implements HasLabel
{
    use HasRandomEnum, HasTranslatableLabel;

    case KEY = 'key';

    case CUSTOM = 'custom';

    public function getLabel(): string
    {
        return $this->getTranslatableLabel();
    }
}
