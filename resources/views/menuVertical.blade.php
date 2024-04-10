@extends('master')

@section('menu-vertical')
    {{-- MENU VERTICAL --}}
    <ul class="nav">
        <li class="nav-item">
            <i class="bi bi-text-left" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft"
                aria-controls="offcanvasLeft">
            </i>
        </li>
    </ul>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">Módulos</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="linha-body-user"></div>
            <nav class="nav flex-column fw-semibold ">
                <a class="nav-link " aria-current="page" href="/">Home</a>
                <a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop" href="#">
                    {{-- <i class="bi bi-people-fill"></i> --}}
                    <span class="span-labels fst-italic">Departamento Pessoal</span>
                </a>
                <a class="nav-link fst-italic" href="/dependentes">Dependentes</a>
                <a class="nav-link" href="/aso">Aso</a>
            </nav>
            <div class="linha-body-user"></div>
        </div>  

        <div class="offcanvas-footer">
            <i class="bi bi-person-circle fs-2"></i>
            <div class="user-email">
                <span class="user fs-5">Administrador</span>
                <span class="email fs-7">adm@adm.com</span>
            </div>
            <i class="bi bi-box-arrow-right fs-5" style="cursor: pointer"></i> {{-- LOGOUT --}}
        </div>
    </div>

    {{-- SUBMENU TOP --}}
    {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Toggle top offcanvas</button> --}}

    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasTopLabel">Offcanvas top</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        ...
    </div>
    </div>

    {{-- CONTENT --}}
    <div class="home-container">
        @yield('content')      
    </div>
@endsection