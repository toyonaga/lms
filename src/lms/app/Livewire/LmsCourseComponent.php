<?php

namespace App\Livewire;

use App\Models\LmsCourse;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class LmsCourseComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $user_id, $course_id, $img_course, $img_thumbnail, $img_background, $title, $permalink, $overview, $target, $metadata, $hours, $level, $price, 
           $type_display, $type_progress, $type_comment, $type_requirement, $total_students, $total_completers, $is_review, $is_deleted;

    protected function rules()
    {
        return [
            'user_id' => 'required|integer',
            'course_id' => 'required|integer',
            'title' => 'required|string',
            'overview' => 'string',
            'level' => 'integer',
        ];
    }

    public function saveCourse()
    {
        $course = new LmsCourse();
        $course->title = $this->title;
        $course->overview = $this->overview;
        $course->level = $this->level;
        Auth::user()->lms_courses()->save($course);
        session()->flash('message','Course Added Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function editCourse(int $course_id)
    {
        $course = LmsCourse::find($course_id);
        if($course){
            $this->user_id = Auth::user()->id;
            $this->course_id = $course->id;
            $this->img_course = $course->img_course;
            $this->img_thumbnail = $course->img_thumbnail;
            $this->img_background = $course->img_background;
            $this->title = $course->title;
            $this->permalink = $course->permalink;
            $this->overview = $course->overview;
            $this->target = $course->target;
            $this->metadata = $course->metadata;
            $this->hours = $course->hours;
            $this->level = $course->level;
            $this->price = $course->price;
            $this->type_display = $course->type_display;
            $this->type_progress = $course->type_progress;
            $this->type_comment = $course->type_comment;
            $this->type_requirement = $course->type_requirement;
            $this->total_students = $course->total_students;
            $this->total_completers = $course->total_completers;
            $this->is_review = $course->is_review;
        }else{
            return redirect()->to('/course');
        }
    }

    public function updateCourse()
    {
        $validatedData = $this->validate();

        LmsCourse::find($this->course_id)->update([
            //'img_course' => $validatedData['img_course'],
            //'img_thumbnail' => $validatedData['img_thumbnail'],
            //'img_background' => $validatedData['img_background'],
            'title' => $validatedData['title'],
            //'permalink' => $validatedData['permalink'],
            'overview' => $validatedData['overview'],
            //'target' => $validatedData['target'],
            //'metadata' => $validatedData['metadata'],
            //'hours' => $validatedData['hours'],
            'level' => $validatedData['level'],
            //'price' => $validatedData['price'],
            //'type_display' => $validatedData['type_display'],
            //'type_progress' => $validatedData['type_progress'],
            //'type_comment' => $validatedData['type_comment'],
            //'type_requirement' => $validatedData['type_requirement'],
            //'total_students' => $validatedData['total_students'],
            //'total_completers' => $validatedData['total_completers'],
            //'is_review' => $validatedData['is_review']
        ]);
        session()->flash('message','Course Updated Successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function deleteCourse(int $course_id)
    {
        $this->course_id = $course_id;
    }

    public function destroyCourse()
    {
        LmsCourse::find($this->course_id)->update([
            'is_deleted' => true
        ]);
        session()->flash('message','Course Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email = '';
        $this->course = '';

        $this->course_id = '';
        $this->img_course = '';
        $this->img_thumbnail = '';
        $this->img_background = '';
        $this->title = '';
        $this->permalink = '';
        $this->overview = '';
        $this->target = '';
        $this->metadata = '';
        $this->hours = 0;
        $this->level = 0;
        $this->price = 0;
        $this->type_display = 1;
        $this->type_progress = 1;
        $this->type_comment = 1;
        $this->type_requirement = 1;
        $this->total_students = 0;
        $this->total_completers = 0;
        $this->is_review = 0;
    }

    public function render()
    {
        $lms_courses = LmsCourse::where([
            ['user_id', Auth::user()->id], 
            ['is_deleted', false], 
            ])->orderBy('id')->paginate(20);
        return view('livewire.lms-course-component', ['lms_courses' => $lms_courses]);
    }

    public function editLessons(int $course_id)
    {
        return redirect()->to('/items?course_id='.$course_id);
    }

    public function showPreview(int $course_id)
    {
        return redirect()->to('/learn?course_id='.$course_id);
    }
}
