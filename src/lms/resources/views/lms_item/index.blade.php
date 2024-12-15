@extends('layouts.app')

@section('content')

    <div>
        <livewire:lms-item-component>
    </div>

@endsection

@section('script')
<script>
    window.addEventListener('close-modal', event => {
        $('#deleteItemModal').modal('hide');
    })
</script>
@endsection