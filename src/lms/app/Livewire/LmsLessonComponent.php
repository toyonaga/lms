<?php

namespace App\Livewire;

use App\Models\LmsCourse;
use App\Models\LmsItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class LmsLessonComponent extends Component
{
    public $item_id;

    public function render(Request $request)
    {
        if (!$this->item_id) $this->item_id = $request->input('lesson_id');

        $lms_item = LmsItem::where([
            ['id', $this->item_id], 
            ['is_deleted', false], 
            ])->first();

        $lms_course = LmsCourse::where([
            ['id', $lms_item->lms_course_id], 
            ['is_deleted', false], 
            ])->first();
        
        $lms_items = LmsItem::where([
            ['lms_course_id', $lms_item->lms_course_id], 
            ['is_deleted', false], 
            ])->orderBy('sort')->paginate(20);

        return view('livewire.lms-lesson-component', ['lms_course' => $lms_course, 'lms_item' => $lms_item, 'lms_items' => $lms_items]);
    }

    public function startLesson(int $lesson_id)
    {
        return redirect()->to('/lesson?lesson_id='.$lesson_id);
    }

    public function showCourse(int $course_id)
    {
        return redirect()->to('/learn?course_id='.$course_id);
    }
}
