<h4><b>{{$snip->title}}</b></h4>
<pre>
    <code>
        <a href="javascript:;" id="snip" data-type="textarea" data-pk="{{$snip->id}}"
           data-placeholder="Snippets" class="editable editable-pre-wrapped editable-click" name="snip">
    {{$snip->snip}}
        </a>
    </code>
</pre>


@push('scripts')
@endpush