var user = "{{Auth::user()->id}}";
var pageAtual = "{{($snpMenu->firstItem()) ? "" : "1"}}";
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
                handleDemo3();
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

var handleDemo3 = function () {
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/twilight");

    editor.getSession().setMode("ace/mode/javascript");
}

handleDemo3();


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
