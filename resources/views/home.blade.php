@extends('layouts.app')


@section('content')

    <br>
    <br>
    <div class="page-content-wrapper">
        <div class="page-content">
            <h1 class="page-title">Snippets</h1>

            <div class="quick-nav-overlay"></div>

<div class="col-md-12">
                <a href="javascript:;" id="comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-original-title="Enter comments" class="editable editable-pre-wrapped editable-click" style="display: inline;">awesome
                <br> user!</a>

</div>
            <br><br><br>
            <button class="btn btn-success" style="margin-top: 25px">Novo</button>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $.fn.editable.defaults.mode = 'inline';

        $('#comments').editable({
            showbuttons: 'bottom'
        });


    </script>
@endpush