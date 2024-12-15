<?php

namespace App\Livewire;

use App\Models\LmsCourse;
use App\Models\LmsItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class LmsLearnComponent extends Component
{
    public $course_id;

    public function render(Request $request)
    {
        if (!$this->course_id) $this->course_id = $request->input('course_id');

        $lms_course = LmsCourse::find($this->course_id);

        $lms_items = LmsItem::where([
            ['lms_course_id', $this->course_id], 
            ['is_deleted', false], 
            ])->orderBy('sort')->paginate(20);

        return view('livewire.lms-learn-component', ['lms_course' => $lms_course, 'lms_items' => $lms_items]);
    }

    public function startLesson(int $lesson_id)
    {
        return redirect()->to('/lesson?lesson_id='.$lesson_id);
    }
}
