<?php

namespace App\Filament\Resources\Blogs\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),

                TextColumn::make('user.name'),

                IconColumn::make('is_published')
                    ->label('Status')
                    ->icon(fn(string $state): Heroicon => match ($state) {
                        '1' => Heroicon::OutlinedCheckCircle,
                        '0' => Heroicon::OutlinedClock,
                    })
                    ->color(fn(string $state): string => match ($state) {
                        '1' => 'success',
                        '0' => 'gray',
                    }),

                TextColumn::make('created_at')
                    ->dateTime('Y-m-d h:i a')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime('Y-m-d h:i a')
                    ->sortable(),

                TextColumn::make('deleted_at')
                    ->dateTime('Y-m-d h:i a')
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                Action::make('publish')
                    ->color('success')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->action(function ($record) {
                        $record->update(['is_published' => true]);
                    }),

                Action::make('draft')
                    ->color('warning')
                    ->icon(Heroicon::OutlinedClock)
                    ->action(function ($record) {
                        $record->update(['is_published' => false]);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),

                    BulkAction::make('publish')
                        ->color('success')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->update(['is_published' => true]));
                        }),

                    BulkAction::make('draft')
                        ->color('warning')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->action(function ($records) {
                            $records->each(fn($record) => $record->update(['is_published' => false]));
                        }),
                ]),
            ]);
    }
}
