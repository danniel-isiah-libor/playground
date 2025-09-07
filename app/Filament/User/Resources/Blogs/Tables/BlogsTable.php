<?php

namespace App\Filament\User\Resources\Blogs\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Kirschbaum\Commentions\Filament\Actions\CommentsAction;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 1,
                'xl' => 1,
            ])
            ->columns([
                Stack::make([
                    TextColumn::make('title')->searchable(),

                    TextColumn::make('content')->html()->searchable(),
                ])
            ])
            ->recordActions([
                EditAction::make()
                    // ->visible(fn($record) => $record->user_id === auth()->user()->id)
                    ->hidden(fn($record) => $record->user_id !== auth()->user()->id),

                CommentsAction::make()
                    ->mentionables(User::all())
            ]);
    }
}
