<div>
    @include('livewire.lms-item-modal')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success initialism">{{ session('message') }}</h5>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">レッスン一覧</h5>
                    </div>
                    <div class="card-body">
                        <div class="float-end">
                            <button type="button" class="btn btn-sm btn-primary" wire:click="newItem(1)"><i class="bi-file-richtext"></i>&nbsp;講座追加</button>&nbsp;
                            <button type="button" class="btn btn-sm btn-primary" wire:click="newItem(2)"><i class="bi-film"></i>&nbsp;動画追加</button>&nbsp;
                            <button type="button" class="btn btn-sm btn-primary" wire:click="newItem(3)"><i class="bi-list-ol"></i>&nbsp;セクション追加</button>
                        </div>
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th class="initialism">種類</th>
                                    <th class="initialism">タイトル</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lms_items as $item)
                                    <tr>
                                        @if ($item->type_item == 1)
                                            <td class="align-middle initialism"><i class="bi-file-richtext fs-5"></i></td>
                                        @elseif ($item->type_item == 2)
                                            <td class="align-middle initialism"><i class="bi-film fs-5"></i></td>
                                        @elseif ($item->type_item == 3)
                                            <td class="align-middle initialism"><i class="bi-list-ol fs-5"></i></td>
                                        @endif
                                        <td class="align-middle initialism">{{ Str::limit($item->title, 10) }}</td>
                                        <td class="align-middle text-end">
                                            <button type="button" wire:click="moveItem({{$item->id}}, 1)" class="btn btn-sm btn-success"><i class="bi-caret-up-fill"></i></button>
                                            <button type="button" wire:click="moveItem({{$item->id}}, 0)" class="btn btn-sm btn-success"><i class="bi-caret-down-fill"></i></button>
                                            <button type="button" wire:click="editItem({{$item->id}})" class="btn btn-sm btn-primary">編集</button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteItemModal" wire:click="deleteItem({{$item->id}})" class="btn btn-sm btn-danger">削除</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">レッスンがありません</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $lms_items->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    @if (!$current_item)
                        <h5 class="mb-0">追加・編集</h5>
                    @elseif ($current_item->type_item == 1 && $current_item->id == 0)
                        <h5 class="mb-0">講座新規追加</h5>
                    @elseif ($current_item->type_item == 1 && $current_item->id != 0)
                        <h5 class="mb-0">講座編集</h5>
                    @elseif ($current_item->type_item == 2 && $current_item->id == 0)
                        <h5 class="mb-0">動画新規追加</h5>
                    @elseif ($current_item->type_item == 2 && $current_item->id != 0)
                        <h5 class="mb-0">動画編集</h5>
                    @elseif ($current_item->type_item == 3 && $current_item->id == 0)
                        <h5 class="mb-0">セクション新規編集</h5>
                    @elseif ($current_item->type_item == 3 && $current_item->id != 0)
                        <h5 class="mb-0">セクション編集</h5>
                    @endif
                    </div>
                    <div class="card-body">
                        <form wire:submit="saveItem">
                        @if (!$current_item)
                            <p class="text-muted">左側にある「追加」ボタンをクリックする事で各種レッスンを作成できます</p>
                        @elseif ($current_item->type_item == 1)
                            <div class="mb-4">
                                <label>タイトル</label>
                                <input wire:model="title" type="text" id="title" name="title" class="form-control">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <div class="clearfix mb-1">
                                    <label>内容</label>
                                    <button type="button" wire:click="editContent({{$current_item->id}})" class="btn btn-sm btn-success float-end">編集</button>
                                </div>
                                <div class="mb-4">
                                    @if ($current_item->content == "")
                                        <p class="text-muted">右上の「編集」ボタンをクリックする事でコンテンツを作成できます</p>
                                    @else
                                        {!! $current_item->content !!}
                                    @endif
                                </div>
                                @error('content')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary float-end">保存</button>
                        @elseif ($current_item->type_item == 2)
                            <div class="mb-4">
                                <label>タイトル</label>
                                <input wire:model="title" type="text" id="title" name="title" class="form-control">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label>動画URL</label>
                                <p class="text-danger text-xs">＊https://youtu.be/XXXXXXXのXXXXXXXのみ入力</p>
                                <input wire:model="content" id="content" name="content" class="form-control">
                                @error('content')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary float-end">保存</button>
                        @elseif ($current_item->type_item == 3)
                            <div class="mb-4">
                                <label>セクション名</label>
                                <input wire:model="title" type="text" id="title" name="title" class="form-control">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary float-end">保存</button>
                        @else
                            {{ $current_item->type_item }}
                        @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
