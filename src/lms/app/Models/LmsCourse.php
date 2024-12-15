<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LmsCourse extends Model
{
    use HasFactory;

    protected $table = 'lms_courses';

    protected $fillable = [
        'img_course',
        'img_thumbnail',
        'img_background',
        'title',
        'permalink',
        'overview',
        'target',
        'metadata',
        'hours',
        'level',
        'price',
        'type_display',
        'type_progress',
        'type_comment',
        'type_requirement',
        'total_students',
        'total_completers',
        'is_review',
        'is_deleted',
    ];
}
