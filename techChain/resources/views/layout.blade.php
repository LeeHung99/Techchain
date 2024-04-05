<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/29ac88f093.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
    <title>Document</title>
</head>
<style>
    .shop-cart {
        padding: 20px 0;
    }

    .content p {
        margin: 0;
    }
</style>

<body>
    <section class="header">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <img src="Poly.webp" alt="" width="80%">
                </div>
                <div class="col-sm-9" style="text-align: right;">
                    <div id="userinfo">
                        @if (Auth::check())           
                            Chào {{Auth::user()->ho}} {{Auth::user()->ten}}! 
                            <a href="/thoat">Thoát</a>
                        @else
                            Chào bạn ! 
                            <a href="/dangnhap">Đăng nhập</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
        
    </section>
    <nav class="navbar nav-tabs navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link activex" aria-current="page" href="/"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-list"></i> Danh mục sản phẩm
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($loaisp as $loai)
                            <li><a class="dropdown-item" href="/loai/{{$loai->id_loai}}">{{$loai->ten_loai}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-phone"></i> Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-list"></i> Góp ý</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hiengiohang"><i class="fa-solid fa-envelope"></i></i> Giỏ Hàng</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Tài khoản
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Đăng nhập</a></li>
                            <li><a class="dropdown-item" href="#">Đăng kí thành viên</a></li>
                            <li><a class="dropdown-item" href="#">Quên mật khẩu</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                            <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                            <li><a class="dropdown-item" href="#">Cập nhật hồ sơ</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Đơn hàng</a></li>
                            <li><a class="dropdown-item" href="#">Hàng đã mua</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="padding: 30px;">
        <div class="row">
            <div class="col-sm-12">
                @yield('noidungchinh')
            </div>
        </div>
</body>

</html>