@extends('layouts.app')

@section('content')

    <div>
        <livewire:lms-course-component>
    </div>

@endsection

@section('script')
<script>
    window.addEventListener('close-modal', event => {
        $('#courseModal').modal('hide');
        $('#updateCourseModal').modal('hide');
        $('#deleteCourseModal').modal('hide');
    })
</script>
@endsection