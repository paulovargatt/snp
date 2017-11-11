@foreach ($snpPaginate as $snip)
    <li class="nav-item">
        <a href="javascript:;" class=""  id="snp" data-id="{{$snip->id}}">
            <i class="fa fa-code"></i>
            <span class="title">{{$snip->title}}</span>
        </a>
    </li>
@endforeach
    @push('scripts')
        <script>

        </script>
    @endpush
