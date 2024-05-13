@php
    $student = Auth::user();
@endphp
<nav class="navbar navbar-expand-lg py-3 justify-content-between" style="background-color: #0866FF">
    <div class="container">
        <a class="navbar-brand text-light" href="#">النور أكاديمي</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav  d-flex justify-content-center align-items-center ">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="#">لوحه التحكم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light " href="#">مقاطع تحفيزية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light " aria-current="page" href="#">السؤال الأسبوعي</a>
                </li>
            </ul>
            <ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ $student->photo == null ? asset('images/user.png') : $user->photo }}"
                            alt="" width="40" height="40">
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">الاعدادت</a></li>
                        <li><a class="dropdown-item" href="#">تقيم السؤال الاسبوعي</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">تسجيل الخروج</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
