@extends('layouts.app')
@push('styles')
    <style>
        .editable-click, a.editable-click, a.editable-click:hover {
            text-decoration: none;
            border-bottom: none;
        }
        pre {
            padding: 0px;
            margin: 0 0 0px;
            font-size: 13px;
            line-height: 1.3;
            word-break: break-all;
            word-wrap: break-word;
            color: #333;
            background-color: #ffffff;
            border: 1px solid #fff;
            overflow: hidden;
        }
        .page-header.navbar .page-logo .logo-default {
            margin: 5px 35px!important;
        }

        .hljs {
            display: block;
            overflow-x: auto;
            padding: 0em;
            background: #ffffff;
            border-color: #fff;
            margin: 0px;
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
                        <h4><b><a href="javascript:;" id="title_snip" data-type="text" data-pk="@if($snipet){{ $snipet->id }}@endif"
                        class="editable editable-click" style="display: inline;">@if($snipet){{$snipet->title}}@endif </a></b></h4>
                      <pre>
                          <code>
                            <a href="javascript:;" id="snip" data-type="textarea" data-pk="@if($snipet){{$snipet->id}}@endif"
                               data-placeholder="Snippets" class="editable editable-pre-wrapped editable-click"
                               name="snip">@if($snipet){{$snipet->snip}}@endif
                            </a>
                          </code>
                      </pre>
                         <button class="btn btn-danger pull-right" id="delete" data-snp="@if($snipet){{$snipet->id}}@endif">Deletar</button>
                    </div>
            <a class="btn blue-madison" style="margin-top: -65px; z-index: 55;position: relative;    margin-left: 16px;"
               data-toggle="modal" href="#draggable"> Novo Snip </a>
        </div>
    </div>

    <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Novo Snippet</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        <form method="post" class="form-horizontal form-bordered form-snip">
                            {{csrf_field()}} {{method_field('POST')}}
                           <div class="input-group">
                             <span class="input-group-addon">
                                <i class="fa fa-code"></i>
                             </span>
                                <input type="text" class="form-control" name="snip_title" placeholder="Titulo Do Snippet">
                           </div>
                            <div class="form-body">
                                <div class="form-group"><br>
                                    <textarea class="form-control" name="snip_text" rows="9" placeholder="Snippet"></textarea>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn green" id="savesnip">Salvar</button>
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var user = "{{Auth::user()->id}}";

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
                            HighColor();
                        },
                        beforeSend: function(){
                            $('#preloader').fadeIn();
                        },
                        complete: function(){
                            $('#preloader').fadeOut("slow");
                        }
                    });
                });


            $(document).on('click', '#delete', function () {
            var snp = $(this).attr('data-snp');
                $.ajax({
                    url: 'delete/' + snp,
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    beforeSend: function(){
                        $('#preloader').fadeIn();
                    },
                    success : function($data) {
                        $('.page-header-fixed').load(' .page-header-fixed');
                        $("#contentGeral").empty();
                        GetLastSnip();
                    },
                    complete: function(){
                        $('#preloader').fadeOut("slow");
                    }
                });
            });

            //Edit Title
            $(document).on('click','#title_snip', function () {
                var id = $(this).attr('data-pk');
                $(this).editable({
                    url: '/edit-title/' +id,
                    pk: 2,
                    title_snip: 'title_snip',
                    success: function(response) {
                        $('.page-header-fixed').load(' .page-header-fixed');

                    }
                });
            });


        });

        $(function(){
            $('#savesnip').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url : '/new-snip',
                    type : "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "snip_title": $('input[name=snip_title]').val(),
                        "snip_text": $('textarea[name=snip_text]').val()
                    },
                    beforeSend: function(){
                        $('#preloader').fadeIn();
                    },
                    success : function($data) {
                        $('.modal').modal('toggle');
                        $('.page-header-fixed').load(' .page-header-fixed');
                        $("#contentGeral").empty();
                        GetLastSnip();
                    },
                    complete: function(){
                        $('#preloader').fadeOut("slow");
                    }
                });
            });
        });


        function GetLastSnip() {
            $.ajax({
                url: '/getlast',
                type: 'GET',
                success: function (content) {
                    $("#loaderFeat").remove();
                    $("#contentGeral").empty();
                    $("#contentGeral").append(content);
                    $('pre > code').each(function () {
                        hljs.highlightBlock(this);
                    });
                },
                beforeSend: function () {
                    $('#preloader').fadeIn();
                },
                complete: function () {
                    $('#preloader').fadeOut("slow");
                }
            });
        };

        function HighColor(){
            $('pre > code').each(function() {
                hljs.highlightBlock(this);
            });
        }



    </script>

@endpush