<?php

namespace App\Models;

use Filament\Forms;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageField extends Model
{
    use HasFactory;

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public static function types(): array
    {
        return [
            Forms\Components\TextInput::class => 'Text',
            Forms\Components\Textarea::class => 'Textarea',
            Forms\Components\Checkbox::class => 'Checkbox',
            Forms\Components\DateTimePicker::class => 'Date Time Picker',
            Forms\Components\TimePicker::class => 'Time Picker',
            Forms\Components\DatePicker::class => 'Date Picker',
            Forms\Components\NumberInput::class => 'Number',

        ];
    }
}
