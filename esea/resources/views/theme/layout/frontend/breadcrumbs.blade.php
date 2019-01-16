@if (count($breadcrumbs))
    <div class="div-block-breadcumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                <a href="{{ $breadcrumb->url }}" class="link-breadcumb-2">{{ $breadcrumb->title }}</a>
                <div class="div-block-24"></div>
            @else
                {{ $breadcrumb->title }}
            @endif
        @endforeach
    </div>
@endif