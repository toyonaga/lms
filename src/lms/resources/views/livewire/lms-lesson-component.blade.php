<div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session()->has('message'))
                    <h5 class="alert alert-success initialism">{{ session('message') }}</h5>
                @endif

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{$lms_item->title}}</h5>
                    </div>
                    <div class="card-body">
                        @if ($lms_item->type_item == 1)
                            {!! $lms_item->content !!}
                        @elseif ($lms_item->type_item == 2)
                            <div class="youtube">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $lms_item->content }}?rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>
                        @elseif ($lms_item->type_item == 3)
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">{{ $lms_course->title }}</h5>
                    </div>
                    <div class="card-body">
                        <img class="mb-2" style="width:100%;aspect-ratio:3/2;object-fit:cover;" src="https://metadirection.com/lms/cover.jpg"/>
                        <button type="button" wire:click="showCourse({{$lms_course->id}})" class="btn btn-sm btn-success w-100">トップページへ</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-light table-borderd table-striped mb-4">
                            <tbody>
                                @forelse ($lms_items as $item)
                                    @if ($item->id == $lms_item->id)
                                        <tr class="table-success">
                                    @else
                                        <tr>
                                    @endif
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
