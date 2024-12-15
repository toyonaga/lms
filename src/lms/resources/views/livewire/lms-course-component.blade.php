<div>
    @include('livewire.lms-course-modal')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success initialism">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">コース一覧</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#courseModal">
                            コース追加
                        </button>
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th class="initialism">タイトル</th>
                                    <th class="initialism">概要</th>
                                    <th class="initialism">レベル</th>
                                    <th class="initialism">更新日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lms_courses as $course)
                                    <tr>
                                        <td class="align-middle initialism">{{ Str::limit($course->title, 20) }}</td>
                                        <td class="align-middle initialism">{{ Str::limit($course->overview, 20) }}</td>
                                        <td class="align-middle initialism">{{ $course->level }}</td>
                                        <td class="align-middle initialism">{{ $course->updated_at }}</td>
                                        <td class="align-middle text-end">
                                            <button type="button" wire:click="showPreview({{$course->id}})" class="btn btn-sm btn-success">プレビュー</button>
                                            <button type="button" wire:click="editLessons({{$course->id}})" class="btn btn-sm btn-primary">レッスン編集</button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#updateCourseModal" wire:click="editCourse({{$course->id}})" class="btn btn-sm btn-primary">コース編集</button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteCourseModal" wire:click="deleteCourse({{$course->id}})" class="btn btn-sm btn-danger">削除</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">コースがありません</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $lms_courses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
