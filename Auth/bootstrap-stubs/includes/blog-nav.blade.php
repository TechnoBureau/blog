<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                @foreach($categories as $category)
                <a class="nav-link collapsed" href="@if($category->childs->isEmpty()) /{{ $category->slug }}/ @else#@endif" data-bs-toggle="collapse" data-bs-target="#{{ $category->name}}_Layout" aria-expanded="false" aria-controls="{{ $category->name}}_Layout">
                    <div class="sb-nav-link-icon"></div>{{ $category->name}}
                @if(!$category->childs->isEmpty())
                <div class="sb-sidenav-collapse-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                    <path d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                </svg>
                </div>
                @endif
                </a>
                
                @if(!$category->childs->isEmpty())
                <div class="collapse" id="{{ $category->name}}_Layout" aria-labelledby="{{ $category->name}}" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @foreach($category->childs as $subcategory)
                        <a class="nav-link" href="/{{ $subcategory->slug }}/">{{$subcategory->name}}</a>
                        @endforeach
                    </nav>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @auth
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
        @endauth
    </nav>
</div>