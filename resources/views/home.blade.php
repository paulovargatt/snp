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
            margin: 0px 23px!important;
            width: 126px;
        }

        .hljs {
            display: block;
            overflow-x: auto;
            padding: 0em;
            background: #ffffff;
            border-color: #fff;
            margin: 0px;
        }
        .page-header.navbar {
            background-color: #364150;
        }

        .select2-container--bootstrap .select2-dropdown {
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.05);
            border-color: #ffffff;
            overflow-x: hidden;
            margin-top: -1px;
            background: #fff;
            z-index: 55551;
        }
        .select2-container--bootstrap .select2-selection {
            background-color: #2f3338;
            border: 0px solid #2f3338;
            border-radius: 4px;
            color: #fff;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            outline: 0;
        }
        .select2-container--bootstrap.select2-container--focus .select2-selection, .select2-container--bootstrap.select2-container--open .select2-selection{
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.01), 0 0 8px rgba(147, 161, 187, 0);
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075), 0 0 8px rgba(147, 161, 187, 0.04);
            border-color: #364150;
        }
        .select2-container--bootstrap .select2-selection--single .select2-selection__rendered, .select2-selection__placeholder {
            color: #e6e7e8!important;
            padding: 0;
        }

        .page-header.navbar {
            background-color: #2f3338!important;
        }

        .page-content-wrapper{
            background: #2f3338!important;
        }

        .page-sidebar-menu, .page-sidebar.collapse, .page-header-fixed{
            background: #2f3338!important;
        }

        .page-container{
            background: #fff;
        }


        .searchbox{
            width: 240px;
            position: absolute;
            left: 240px;
            top: 7px;
        }

        /*Media Queries*/
        @media screen and (max-width: 768px) {
            .searchbox {
                width: 100%!important;
                position: absolute;
                left: 0px;
                top: 50px;
            }

            a.btn.btn-circle.btn-icon-only.grey-mint{
                z-index: 555;
            }
            .select2-container--bootstrap .select2-selection--single{
                 height: 39px!important;
            }
            .select2 .select2-container .select2-container--bootstrap {
                width: 100% !important;
            }

            .page-content{
                width:100%;
            }

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
                    <div class="col-md-12" id="contentGeral" style="width: 100%; padding:0px 0px;">
                        @if($snipet)
                        <h4 style="margin-bottom: -15px;"><b><a href="javascript:;" id="title_snip" data-type="text" data-pk="@if($snipet){{ $snipet->id }}@endif"
                        class="editable editable-click">@if($snipet){{$snipet->title}}@endif </a></b></h4>
                      <pre>
                          <code>
                            <a href="javascript:;" id="snip" data-type="textarea" data-pk="@if($snipet){{$snipet->id}}@endif"
                               data-placeholder="Snippets" style="display: block;padding: 0px;margin-top: -20px;" class="editable editable-pre-wrapped editable-click mt-clipboard-container"
                               name="snip">@if($snipet){{$snipet->snip}}@endif
                            </a>
                          </code>
                      </pre>
                        @endif
                        @if($snipet)

                            <button  class="btn red-mint pull-right"
                                    id="delete" data-snp="@if($snipet){{$snipet->id}}@endif"> Deletar!</button>@endif
                    </div>
            <a href="javascript:;" style="top: -35px; position: relative; left: 16px;" class="btn dark mt-clipboard " data-clipboard-action="copy"
               data-clipboard-target=".mt-clipboard-container">  <i class="icon-note"></i> Copiar Snip</a>
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
                             <span class="input-group-addon"><i class="fa fa-code"></i></span>
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
        var pg = "{{$snpMenu->firstItem()}}";
        var pageAtual = pg == '' ? '1' : pg == '1';

        var totalPages = "{{$snpMenu->lastPage()}}";

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
                            $("#contentGeral").append(content).hide().fadeIn(500);
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
                        $("#contentGeral").empty();
                    },
                    complete: function(){
                        $('#preloader').fadeOut("slow");
                        GetLastSnip();
                        cargaMenu();
                    }
                });
            });

            //Edit Title
            $(document).on('click','#title_snip', function () {
                var id = $(this).attr('data-pk');
                if(id.length < 1){
                    alert('Insira um titulo');
                }
                $(this).editable({
                    url: '/edit-title/' +id,
                    pk: 2,
                    title_snip: 'title_snip',
                    success: function(response) {
                        cargaMenu();
                    },
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
                        "snip_text": $('textarea[name=snip_text]').val(),
                    },
                    beforeSend: function(){
                        $('#preloader').fadeIn();
                    },
                    success : function($data) {
                        $('.modal').modal('toggle');
                        $("#contentGeral").empty();
                    },
                    complete: function(){
                        $('#preloader').fadeOut("slow");
                        GetLastSnip();
                        cargaMenu();
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
                    $("#contentGeral").append(content).hide().fadeIn(500);
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
        }

        function HighColor(){
            $('pre > code').each(function() {
                hljs.highlightBlock(this);
            });
        }

       function UpSelectTwo() {
           $('#multi-append').select2({
                language: "pt-BR",
                placeholder: "Pesquise na sua coleção",
                minimumInputLength: 1,
                minimumResultsForSearch: Infinity,
                multiple: false,
                ajax: {
                    url: '/snip/find',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }

            });


           $(document.body).on("change","#multi-append",function(){
               var str = "";
               $( "select option:selected" ).each(function() {
                   str += $( this ).val() + "";
               });
               $.ajax({
                   url: '/content/' + str,
                   type: 'GET',
                   success: function (content) {
                       $('#contentGeral').empty();
                       $("#loaderFeat").remove();
                       $("#contentGeral").append(content).hide().fadeIn(500);
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
       }
        function cargaMenu() {
            $('.page-header-fixed').empty();
            $.ajax({
                url: '/paginate',
                type: 'GET',
                success: function (content) {
                    $(".page-sidebar-menu").append(content).hide().fadeIn(500);
                }
            });
        }

        $(document).on('ready', function () {
            UpSelectTwo();
            cargaMenu();

            if(pageAtual == totalPages ){
                $('#paginate').remove();
            }
        });

        $(document).on('click', '#paginate', function () {
            pageAtual++;

            if(pageAtual == totalPages ){
                $(this).remove();
            }


            $.ajax({
                url: '/paginate?page='+ pageAtual,
                type: 'GET',
                success: function (content) {
                    $(".page-sidebar-menu").append(content).hide().fadeIn(500);
                },
                beforeSend: function(){
                    $('#preloader').fadeIn();
                },
                complete: function(){
                    $('#preloader').fadeOut("slow");

                }
            });
        });

            var paste_text;

            $('.mt-clipboard').each(function(){
                var clipboard = new Clipboard(this);
                clipboard.on('success', function(e) {
                    paste_text = e.text;
                });

                $(document).on('click', '.mt-clipboard', function () {
                    if($(this).data('clipboard-paste') == true){
                        if(paste_text){
                            var paste_target = $(this).data('paste-target');
                            $(paste_target).val(paste_text);
                            $(paste_target).html(paste_text);
                        } else {
                            alert('No text was copied or cut.');
                        }
                    }
                });
            });



    </script>

@endpush