@if(session('success'))
    <div class="d-none success-message" data-message="{{ session('success') }}"></div>
@endif

@if(session('error'))
    <div class="d-none error-message" data-message="{{ session('error') }}"></div>
@endif

@if(session('info'))
    <div class="d-none info-message" data-message="{{ session('info') }}"></div>
@endif

@if(session('warning'))
    <div class="d-none warning-message" data-message="{{ session('warning') }}"></div>
@endif

