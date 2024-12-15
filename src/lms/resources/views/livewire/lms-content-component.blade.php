<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success initialism">{{ session('message') }}</h5>
                @endif
            </div>
            <div class="col-md-12">
                <div class="card">
                    <livewire:jodit-text-editor wire:model="content" :buttons="['bold', 'italic', 'underline', 'strikeThrough', 'paragraph', '|', 'left', 'center', 'right', '|', 'ul', 'ol', '|', 'image', 'video', '|', 'undo', 'redo']"/>
                </div>
                <div class="float-end">
                    <button type="button" class="btn btn-secondary" onclick=history.back()>キャンセル</button>
                    <button type="submit" class="btn btn-primary" wire:click="saveItem()">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>