@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@push('script')
    <script>
        $(document).ready(() => {
            $('.sub').on('click', function (){
                if($(this).find('.submenus').css('display') == 'none'){
                    $(this).find('.submenus').fadeIn();
                }else{
                    $(this).find('.submenus').fadeOut();
                }
            });

            $('.submenu-mobile').on('click', function(){
                if($('aside').css('display') == 'block'){
                    $('aside').hide();
                }else{
                    $('aside').show();
                }
            });
        })
    </script>
@endpush

<div class="navigation shadow-sm">
    <div class="d-flex align-items-center">
        <div class="btn-submenu me-2"><a href="javascript:void(0)" class="submenu-mobile"><i class="bi bi-list"></i></a></div>
        <a href="{{ route('admin.dashboard') }}">
            <strong>Sendikasih Sandika</strong>
        </a>
    </div>
    <div>
        <div class="nav">
            <ul>
                <li><a href="#" class="btn-fullscreen"><i class="bi bi-arrows-fullscreen"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle fn" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <div class="dropdown-profile">
                                <div class="photo-user"><i class="bi bi-person-circle"></i></div>
                                <div class="name">
                                    <small>{{ '@' . Auth::guard('admin')->user()->username }}</small>
                                </div>
                            </div>
                            <div class="drowdown-profile-footer border-top d-flex align-items-center justify-content-between text-center">
                                <a class="dropdown-item" href="{{ route('admin.setting') }}"><i class="bi bi-gear"></i></a>
                                <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-in-right"></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="breadcrumb-wrapper">
    <h4>{{ ucwords(str_replace('-', ' ', Request::segment(2))) }}</h4>
    <nav class="breadcrumb">
        @foreach (explode('/', Request::path()) as $i => $item)
            @if ($i+1 < count(explode('/', Request::path())))
                <a class="breadcrumb-item" href="#">{{ ucwords(str_replace('-', ' ', $item)) }}</a>
            @else 
                <span class="breadcrumb-item">{{ ucwords(str_replace('-', ' ', $item)) }}</span>
            @endif
        @endforeach
    </nav>
</div>