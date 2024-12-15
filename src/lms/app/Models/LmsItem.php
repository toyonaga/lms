<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LmsItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'sort',
        'type_item',
        'is_deleted',
    ];
}
