<?php

namespace App\Livewire;

use App\Models\LmsItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Livewire\Component;

class LmsContentComponent extends Component
{
    public $course_id, $item_id, $content;

    protected function rules()
    {
        return [
            'content' => 'string',
        ];
    }

    public function saveItem()
    {
        $validatedData = $this->validate();

        LmsItem::find($this->item_id)->update([
            'content' => $validatedData['content']
        ]);
        return redirect()->to('/items?course_id='.$this->course_id);
    }

    public function render(Request $request)
    {
        if (!$this->item_id) $this->item_id = $request->input('item_id');

        $item = LmsItem::find($this->item_id);

        if (Auth::user()->id == $item->user_id) {
            $this->content = $item->content;
            $this->course_id = $item->lms_course_id;
            return view('livewire.lms-content-component');
        }
    }
}
