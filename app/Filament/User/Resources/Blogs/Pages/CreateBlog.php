<?php

namespace App\Filament\User\Resources\Blogs\Pages;

use App\Filament\User\Resources\Blogs\BlogResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordCreation(array $data): Model
    {
        $data['user_id'] = Auth::user()->id; // auth()->user()->id;

        return parent::handleRecordCreation($data);
    }
}
