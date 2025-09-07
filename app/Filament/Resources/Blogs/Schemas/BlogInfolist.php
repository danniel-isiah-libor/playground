<?php

namespace App\Filament\Resources\Blogs\Schemas;

use App\Models\User;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\Commentions\Filament\Infolists\Components\CommentsEntry;

class BlogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextEntry::make('title')->hiddenLabel(),

                TextEntry::make('content')->html()->hiddenLabel(),

                CommentsEntry::make('comments')
                    ->mentionables(fn(Model $record) => User::all()),
            ]);
    }
}
