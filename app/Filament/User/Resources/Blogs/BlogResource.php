<?php

namespace App\Filament\User\Resources\Blogs;

use App\Filament\Resources\Blogs\Pages\EditBlog;
use App\Filament\Resources\Blogs\Pages\ViewBlog;
use App\Filament\Resources\Blogs\Schemas\BlogForm;
use App\Filament\User\Resources\Blogs\Pages\CreateBlog;
use App\Filament\User\Resources\Blogs\Pages\ListBlogs;
use App\Filament\User\Resources\Blogs\Schemas\BlogInfolist;
use App\Filament\User\Resources\Blogs\Tables\BlogsTable;
use App\Models\Blog;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Newsfeed';

    protected static ?string $pluralModelLabel = 'Newsfeed';

    public static function form(Schema $schema): Schema
    {
        return BlogForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BlogInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BlogsTable::configure($table);
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
            'index' => ListBlogs::route('/'),
            'create' => CreateBlog::route('/create'),
            'view' => ViewBlog::route('/{record}'),
            'edit' => EditBlog::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_published', true)->orderBy('updated_at', 'desc');
    }
}
