@extends('layouts.app')
@push('styles')
    <style>
        .editable-click, a.editable-click, a.editable-click:hover {
            text-decoration: none;
            border-bottom: none;
        }
        pre {
            /* display: block; */
             padding: 0px;
            margin: 0 0 0px;
            font-size: 13px;
            line-height: 1.42857;
            word-break: break-all;
            word-wrap: break-word;
            color: #333;
            background-color: #ffffff;
            border: 1px solid #fff;
            overflow: hidden;
            /* border-radius: 4px; */
        }
    </style>
@endpush
@section('content')
    <div id="_token" class="hidden" data-token="{{ csrf_token() }}"></div>
    <br>
    <br>
    <div class="page-content-wrapper">
        <div class="page-content">

            <div class="quick-nav-overlay"></div>
        <div class="col-md-12" id="contentGeral">
        </div>
            <br><br><br>
            <button class="btn btn-success" style="margin-top: 25px">Novo</button>


        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.fn.editable.defaults.params = function (params) {
                params._token = $("#_token").data("token");
                return params;
            };
                $.fn.editable.defaults.mode = 'inline';

                $(document).on('click', '#snip', function () {
                    var ide = $(this).attr('data-pk');
                    $(this).editable({
                        url: '/update-content/' + ide,
                        tpl: '<textarea type="text" class="code" style="padding-right:4px;height:300px;width: 800px!important;">',
                        showbuttons: 'bottom',
                        success: function(response) {
                                hljs.highlightBlock(this);
                        }
                    });
                });


                $(document).on('click', '#snp', function () {
                    $("#contentGeral").empty();
                    var id = $(this).attr('data-id');

                    $("#snp").click(function () {
                        $('#snip').addClass('ativo'+id);
                    });

                    if($('#snip').hasClass('ativo'+id)){
                       abort();
                    }


                    $.ajax({
                        url: '/content/' + id,
                        type: 'GET',
                        success: function (content) {
                            $("#loaderFeat").remove();
                            $("#contentGeral").append(content);
                            $('pre > code').each(function() {
                                hljs.highlightBlock(this);
                            });
                        }

                    })
                });




        });
    </script>

@endpush