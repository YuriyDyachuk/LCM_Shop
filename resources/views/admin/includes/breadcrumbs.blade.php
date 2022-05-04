@if(!empty($breadcrumbs))
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @foreach($breadcrumbs as $breadcrumbLink=>$breadcrumbName)
                <li class="breadcrumb-item"><a href="{{ $breadcrumbLink }}">{{ $breadcrumbName }}</a></li>
            @endforeach
            @if (!empty($pageTitle))
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
            @endif
        </ol>
    </nav>
@endif
