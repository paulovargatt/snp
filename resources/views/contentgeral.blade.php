<h4><b><a href="javascript:;" id="title_snip" data-type="text" data-pk="{{$snip->id}}"
   class="editable editable-click"
   style="display: inline;"> {{$snip->title}} </a></b></h4>
<pre>
    <code>
        <a href="javascript:;" id="snip" data-type="textarea" data-pk="{{$snip->id}}"
           data-placeholder="Snippets" class="editable editable-pre-wrapped editable-click" name="snip">
    {{ $snip->snip }}
        </a>
    </code>
</pre>
<button class="btn btn-danger pull-right" id="delete" data-snp="{{$snip->id}}">Deletar</button>