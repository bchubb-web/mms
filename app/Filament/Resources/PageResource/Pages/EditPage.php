<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\PageField;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $fields = $this->getRecord()->fields()->get();
        foreach ($fields as $field) {
            $data["page_field__{$field->id}"] = $field->value;
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $pageFields = array_filter($data, fn ($key) => str_starts_with($key, 'page_field__'), ARRAY_FILTER_USE_KEY);

        $fieldModels = PageField::query()
            ->whereIn('id', array_map(fn ($key) => (int) explode('__', $key)[1], array_keys($pageFields)))
            ->get()
            ->keyBy('id');

        foreach ($fieldModels as $pageField) {
            $pageField->value = $pageFields["page_field__{$pageField->id}"];
            $pageField->save();
            unset($data["page_field__{$pageField->id}"]);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
