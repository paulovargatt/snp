@foreach ($snpPaginate as $snip)
    <li class="nav-item ">
        <a href="javascript:;" class="tooltips"   id="snp" data-id="{{$snip->id}}" data-original-title="12" >
            <i class="fa fa-code"></i>
            <span class="title tooltips" >{{$snip->title}}</span>
        </a>
    </li>
@endforeach
    @push('scripts')
        <script>

        </script>
    @endpush