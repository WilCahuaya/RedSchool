@auth()
    @include('layouts.navbars.navs.auth_admin')
@endauth

@guest()
    @include('layouts.navbars.navs.guest')
@endguest
