<?php

namespace App\Livewire;

use App\Models\LmsItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\Component;

class LmsItemComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $user_id, $course_id, $item_id, $title, $content, $sort, $type_item, $is_deleted;
    
    public ?LmsItem $current_item = null;

    protected function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'string',
        ];
    }

    public function newItem(int $type)
    {
        $this->current_item = new LmsItem();
        $this->current_item->type_item = $type;
        $this->type_item = $type;
        $this->title = '';
        $this->content = '';
    }

    public function saveItem()
    {
        if ($this->current_item->id == 0) {
            $count = LmsItem::where([
                ['user_id', Auth::user()->id], 
                ['lms_course_id', $this->course_id], 
                ['is_deleted', false], 
                ])->count();
            $this->current_item->lms_course_id = $this->course_id;
            $this->current_item->title = $this->title;
            $this->current_item->content = $this->content;
            $this->current_item->type_item = $this->type_item;
            $this->current_item->sort = $count + 1;
            Auth::user()->lms_items()->save($this->current_item);
            session()->flash('message','Item Added Successfully');
        } else {
            $validatedData = $this->validate();
            LmsItem::find($this->current_item->id)->update([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
            ]);
            session()->flash('message','Item Updated Successfully');
        }
    }

    public function editItem(int $item_id)
    {
        $item = LmsItem::find($item_id);
        if($item){
            $this->current_item = $item;
            $this->type_item = $item->type_type;
            $this->title = $item->title;
            $this->content = $item->content;
        }else{
            return redirect()->to('/lesson?course_id='.$this->course_id);
        }
    }

    public function moveItem(int $item_id, int $is_up)
    {
        $item_a = LmsItem::find($item_id);
        $sort = $item_a->sort;

        $lms_items = LmsItem::where([
            ['user_id', Auth::user()->id], 
            ['lms_course_id', $this->course_id], 
            ['is_deleted', false], 
            ])->orderBy('sort')->get();
        $max = count($lms_items) -1;

        if (!($sort == 0 && $is_up == 1)&&!($sort == $max && $is_up == 0)) {
                if ($is_up == 1) {
                $sort--;
            } else {
                $sort++;
            }

            $item_b = LmsItem::where([
                ['user_id', Auth::user()->id], 
                ['lms_course_id', $this->course_id], 
                ['sort', $sort], 
                ])->first();
            $item_b->update(['sort' => $item_a->sort]);
            $item_a->update(['sort' => $sort]);
            session()->flash('hidden','Item Updated Successfully');
        }
    }

    public function deleteItem(int $item_id)
    {
        $this->item_id = $item_id;
    }

    public function destroyItem()
    {
        LmsItem::find($this->item_id)->update([
            'is_deleted' => true
        ]);

        $lms_items = LmsItem::where([
            ['user_id', Auth::user()->id], 
            ['lms_course_id', $this->course_id], 
            ['is_deleted', false], 
            ])->orderBy('sort')->get();
        
        for ($i=0 ; $i<count($lms_items) ; $i++) {
            $lms_items[$i]->update([
                'sort' => $i
            ]);
        }

        session()->flash('message','Item Deleted Successfully');
        $this->dispatch('close-modal');
    }

    public function closeModal()
    {
        
    }

    public function render(Request $request)
    {
        if (!$this->course_id) $this->course_id = $request->input('course_id');

        $lms_items = LmsItem::where([
            ['user_id', Auth::user()->id], 
            ['lms_course_id', $this->course_id], 
            ['is_deleted', false], 
            ])->orderBy('sort')->paginate(10);
        
        return view('livewire.lms-item-component', ['lms_items'=>$lms_items, 'current_item'=>$this->current_item]);
    }

    public function editContent(int $item_id)
    {
        return redirect()->to('/content?item_id='.$item_id);
    }
}
