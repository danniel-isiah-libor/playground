<?php

namespace App\Filament\Resources\Blogs\Pages;

use App\Filament\Resources\Blogs\BlogResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Kirschbaum\Commentions\Filament\Actions\CommentsAction;

class ViewBlog extends ViewRecord
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),

            CommentsAction::make(),
        ];
    }
}
