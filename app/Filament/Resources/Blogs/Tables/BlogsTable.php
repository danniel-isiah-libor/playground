<?php

namespace App\Filament\Resources\Blogs\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Kirschbaum\Commentions\Filament\Actions\CommentsAction;

class BlogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable(),

                TextColumn::make('user.name')->searchable(),

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

                SelectFilter::make('is_published')->options([
                    '1' => 'Published',
                    '0' => 'Draft',
                ]),

                // Filter::make('created_at')
                //     ->schema([
                //         DatePicker::make('created_from'),
                //         DatePicker::make('created_until'),
                //     ])
                //     ->query(function (Builder $query, array $data): Builder {
                //         return $query
                //             ->when(
                //                 $data['created_from'],
                //                 fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                //             )
                //             ->when(
                //                 $data['created_until'],
                //                 fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                //             );
                //     }),

                Filter::make('updated_at')
                    ->schema([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                        DatePicker::make('updated_from'),
                        DatePicker::make('updated_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            )
                            ->when(
                                $data['updated_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('updated_at', '>=', $date),
                            )
                            ->when(
                                $data['updated_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('updated_at', '<=', $date),
                            );
                    })
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

                CommentsAction::make()
                    ->mentionables(User::all())
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
