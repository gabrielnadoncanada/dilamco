<?php

namespace App\Filament\Fields;

use App\Models\Navigation;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Config;

class UrlSelectionField extends Forms\Components\Field
{
    protected string $view = 'filament-forms::components.group';

    public bool $hasLabel = true;

    public function hasLabel($hasLabel)
    {
        $this->hasLabel = $hasLabel;

        return $this;
    }

    public function getChildComponents(): array
    {
        $columns = 4;
        if ($this->getModel() === Navigation::class) {
            $columns = 1;
        }
        if (! $this->hasLabel) {
            $columns = 3;
        }

        return [
            Group::make()
                ->columns($columns)
                ->schema([
                    Select::make('type')
                        ->options($this->getTypeOptions())
                        ->afterStateUpdated(function ($state, Select $component) {
                            $component->getContainer()->getComponent(fn (Component $component) => $component instanceof Group)?->getChildComponentContainer()->fill();
                        })
                        ->reactive()
                        ->default('External'),
                    Group::make()
                        ->live()
                        ->schema(fn (Get $get) => [$this->getItemTypeFields($get('type') ?? 'External')]),
                    TextInput::make('title')
                        ->required()
                        ->live()
                        ->hidden(fn ($state) => $this->hasLabel === false),
                    Select::make('target')
                        ->options([
                            '' => __('filament.menu.select-options.same-tab'),
                            '_blank' => __('filament.menu.select-options.new-tab'),
                        ])
                        ->default('')
                        ->selectablePlaceholder(false),
                ]),
        ];
    }

    protected function getTypeOptions(): array
    {
        $itemTypes = $this->getItemTypes();

        return array_combine(array_keys($itemTypes), array_values($itemTypes));
    }

    protected function getItemTypes(): array
    {
        return Config::get('filament-navigation.navigation_item_types', []);
    }

    protected function getItemTypeFields(string $type)
    {
        if ($type === 'External') {
            return TextInput::make('slug')
                ->required()
                ->default('#');

        }

        $modelClass = $type;
        if (class_exists($modelClass)) {
            return Select::make('slug')
                ->options($modelClass::pluck('title', 'id')->toArray())
                ->live()
                ->afterStateUpdated(function ($state, Select $component, $set, $get) {
                    $set('title', $component->getOptionLabel());
                })
                ->required();
        }

        return null;
    }
}
