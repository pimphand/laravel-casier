<div>
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 main-header">
                    <h2>{{ $title_page ?? env('APP_NAME') }}</h2>
                    {{-- <h6 class="mb-0">admin panel</h6> --}}
                </div>
                <div class="col-lg-6 breadcrumb-right">
                    {{-- <ol class="breadcrumb">
                        @foreach ($breadcrumb as $item)
                        <li class="breadcrumb-item @if (isset($item['active']) && $item['active']) active @endif">
                            @if (isset($item['url']))
                            <a href="{{ $item['url'] }}">
                                @if (isset($item['icon']))
                                <i class="{{ $item['icon'] }}"></i>
                                @endif
                                {{ $item['label'] }}
                            </a>
                            @else
                            {{ $item['label'] }}
                            @endif
                        </li>
                        @endforeach
                    </ol> --}}
                </div>
            </div>
        </div>
    </div>
</div>