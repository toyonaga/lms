<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success initialism">{{ session('message') }}</h5>
                @endif

                <div class="card mb-4">
                    <div class="card-body bg-dark" style="background-image:url(https://metadirection.com/lms/cover.jpg);background-repeat:no-repeat;background-position:right;background-size:30%;">
                        <h2 class="text-white mb-4">{{ $lms_course->title }}</h2>
                        <p class="text-white text small lh-1 mb-4"><span class="p-2 border rounded-3 border-secondary">スポーツ</span>&nbsp;★★★★☆</p>
                        <p class="text-white text small lh-1">講師：豊永　篤</p>
                        <p class="text-white text small lh-1">所属：有限会社メタディレクション</p>
                        <p class="text-white text small lh-1">最終更新：{{ $lms_course->updated_at }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">概要</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $lms_course->overview }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">レッスン</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-borderd table-striped mb-4">
                            <tbody>
                                @forelse ($lms_items as $item)
                                    <tr>
                                        @if ($item->type_item == 1)
                                            <td class="align-middle initialism"><i class="bi-file-richtext fs-5"></i>&nbsp;{{ Str::limit($item->title, 20) }}</td>
                                            <td class="align-middle text-end">
                                                <button type="button" wire:click="startLesson({{$item->id}})" class="btn btn-sm btn-success">開始</button>
                                            </td>
                                        @elseif ($item->type_item == 2)
                                            <td class="align-middle initialism"><i class="bi-film fs-5"></i>&nbsp;{{ Str::limit($item->title, 20) }}</td>
                                            <td class="align-middle text-end">
                                                <button type="button" wire:click="startLesson({{$item->id}})" class="btn btn-sm btn-success">開始</button>
                                            </td>
                                        @elseif ($item->type_item == 3)
                                            </tr>
                                        </tbody>
                                    </table>
                                <h5>{{ Str::limit($item->title, 20) }}</h5>
                                    <table class="table table-light table-borderd table-striped mb-4">
                                        <tbody>
                                            <tr>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">レッスンがありません</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
