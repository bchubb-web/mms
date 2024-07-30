<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $fields = $form->getRecord()?->fields()->get()->toArray();

        $fields = $fields ?? [];

        $formFields = array_map(function ($field) {
            return $field['filament_input_type']::make('page_field__'.$field['id'])
                ->columnSpan(3)
                ->label($field['label']);
        }, $fields);

        return $form
            ->columns(3)
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->columnSpan(1)
                    ->required(),

                Forms\Components\Section::make(
                    'Fields'
                )->schema($formFields),

                Forms\Components\Select::make('template')
                    ->options(
                       Page::templates()
                    )
                    ->default('default')
                    ->selectablePlaceholder(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->width('200px')
                    ->prefix('/')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        // refactor to only show if has permission to edit page schema
        return [
            RelationManagers\PageFieldRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
