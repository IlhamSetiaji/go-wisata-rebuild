<!DOCTYPE html>
<html lang="en" data-footer="true">

{{-- head --}}
@include('layouts.head')

<body>
    <div id="root">
        {{-- navbar --}}
        @include('layouts.navbar')
        <main>
            @yield('content')
        </main>
        <!-- Layout Footer Start -->
        @include('layouts.footer')
        <!-- Layout Footer End -->
    </div>

    <!-- Theme Settings Modal Start -->
    @include('layouts.theme-settings')
    <!-- Theme Settings Modal End -->

    <!-- Theme Settings & Niches Buttons Start -->
    @include('layouts.theme-button')
    <!-- Theme Settings & Niches Buttons End -->

    <!-- Search Modal Start -->
    @include('layouts.search')
    <!-- Search Modal End -->
    @stack('modals')
    @include('layouts.scripts')
    @stack('scripts')
</body>

</html>
