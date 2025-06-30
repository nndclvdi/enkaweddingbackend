<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingTestimonialResource\Pages;
use App\Filament\Resources\WeddingTestimonialResource\RelationManagers;
use App\Models\WeddingTestimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingTestimonialResource extends Resource
{
    protected static ?string $model = WeddingTestimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('occupation')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->required(),

                Forms\Components\Select::make('wedding_package_id')
                    ->relationship('weddingpackage', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Textarea::make('message')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\ImageColumn::make('photo')
                ->circular(),
                
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                
                Tables\Columns\ImageColumn::make('weddingPackage.thumbnail'),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWeddingTestimonials::route('/'),
            'create' => Pages\CreateWeddingTestimonial::route('/create'),
            'edit' => Pages\EditWeddingTestimonial::route('/{record}/edit'),
        ];
    }
}
