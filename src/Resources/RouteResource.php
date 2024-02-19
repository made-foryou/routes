<?php

namespace MadeForYou\Routes\Resources;

use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use MadeForYou\News\Models\Post;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use MadeForYou\Routes\Models\Route;
use MadeForYou\Categories\Models\Category;
use MadeForYou\Routes\Resources\RouteResource\ListRoutesPage;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    #[\Override]
    public static function form(Form $form): Form
    {
        return $form;
    }

    #[\Override]
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('routed')
                    ->label('Onderdeel')
                    ->formatStateUsing(function (Route $route) {
                        $type = '';

                        if ($route->routed instanceof Category) {
                            $type = 'Categorie: ';
                        }

                        if ($route->routed instanceof Post){

                        }
                    }),

                TextColumn::make('url')
                    ->label('URL'),

                TextColumn::make('updated_at')
                    ->label("Laatste gewijzigd op")
                    ->since(),
            ]);
    }

    #[\Override]
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist;
    }

    #[\Override]
    public static function getPages(): array
    {
        return [
            'index' => ListRoutesPage::route('/'),
        ];
    }
}
