<h4 style="margin-bottom: -20px;"><b><a href="javascript:;" id="title_snip" data-type="text" data-pk="{{$snip->id}}"
   class="editable editable-click font-blue-ebonyclay"
   > {{$snip->title}} </a></b></h4>
<pre>
    <code>
        <a href="javascript:;" id="snip" data-type="textarea" data-pk="{{$snip->id}}"
           data-placeholder="Snippets"
           style="display: block;padding: 0px;margin-top: -20px;background: url(https://i.imgur.com/2cOaJ.png);
           background-repeat: no-repeat;padding-left: 35px;padding-top: 11px;border-color:#ccc;"
           class="editable editable-pre-wrapped editable-click mt-clipboard-container" name="snip">
    {{ $snip->snip }}
        </a>
    </code>
</pre>


<button class="btn btn-danger pull-right" id="delete" data-snp="{{$snip->id}}">Deletar</button>

