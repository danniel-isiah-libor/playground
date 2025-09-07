<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('content')
                    ->required()
                    ->fileAttachmentsDirectory('blogs'),
            ]);
    }
}
