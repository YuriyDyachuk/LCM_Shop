<div id="js-server-messages-box" class="server-messages-box">
    <div id="js-server-message-success">{{ session('success') }}</div>
    <div id="js-server-message-errors">
        @if (session()->has('mistakes'))
            @foreach (session('mistakes') as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
    </div>
</div>
<!--Validation errors-->
@if ($errors->any())
    <div class="js-validation-alert-box alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
        <button type="button" class="btn-close js-btn-close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

