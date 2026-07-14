<ul class="genesis-skip-link">
    <li><a href="#genesis-content" class="screen-reader-shortcut"> Saltar al contenido principal</a></li>
    <li><a href="#genesis-footer-widgets" class="screen-reader-shortcut"> Saltar al pie de página</a></li>
</ul>
<header class="site-header" itemscope itemtype="https://schema.org/WPHeader">
    <div class="wrap">
        <div class="title-area">
            <p class="site-title" itemprop="headline"><a href="{{ url('/') }}">Mirage México</a></p>
            <p class="site-description" itemprop="description">Marca especializada en aires acondicionados y
                línea blanca.</p>
        </div>
        <nav class="nav-primary" aria-label="Principal" itemscope itemtype="https://schema.org/SiteNavigationElement"
            id="genesis-nav-primary">
            <div class="wrap">
                <ul id="menu-header-menu" class="menu genesis-nav-menu menu-primary js-superfish">
                    <li id="menu-item-976"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-821 current_page_item menu-item-976">
                        <a href="{{ url('/') }}" aria-current="page" itemprop="url"><span
                                itemprop="name">Inicio</span></a>
                    </li>
                    <li id="menu-item-20281"
                        class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-20281">
                        <a href="{{ url('/catalogo/todo') }}" itemprop="url"><span
                                itemprop="name">Productos</span></a>
                        <ul class="sub-menu">
                            @foreach($categories as $cat)
                            <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat {{ $cat->children->isNotEmpty() ? 'menu-item-has-children' : '' }}">
                                <a href="{{ route('catalogo.category', ['slug' => $cat->slug ?? $cat->uuid]) }}" itemprop="url"><span itemprop="name">{{ $cat->name }}</span></a>
                                @if($cat->children->isNotEmpty())
                                <ul class="sub-menu">
                                    @foreach($cat->children as $child)
                                    <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat {{ $child->children->isNotEmpty() ? 'menu-item-has-children' : '' }}">
                                        <a href="{{ route('catalogo.category', ['slug' => $child->slug ?? $child->uuid]) }}" itemprop="url"><span itemprop="name">{{ $child->name }}</span></a>
                                        @if($child->children->isNotEmpty())
                                        <ul class="sub-menu">
                                            @foreach($child->children as $grandchild)
                                            <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat">
                                                <a href="{{ route('catalogo.category', ['slug' => $grandchild->slug ?? $grandchild->uuid]) }}" itemprop="url"><span itemprop="name">{{ $grandchild->name }}</span></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li id="menu-item-29630"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29630"><a
                            href="{{ url('/ubicaciones') }}" itemprop="url"><span
                                itemprop="name">Ubicaciones</span></a></li>
                    <li id="menu-item-1273"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1273"><a
                            href="{{ url('/soporte') }}" itemprop="url"><span itemprop="name">Soporte</span></a>
                    </li>
                    <li id="menu-item-1255"
                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-has-children menu-item-1255">
                        <a href="{{ url('/comunicacion/sala') }}" itemprop="url"><span
                                itemprop="name">Mirage</span></a>
                        <ul class="sub-menu">
                            <li id="menu-item-21797"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21797">
                                <a href="{{ url('/corporativo/como-ser-distribuidor-mirage') }}"
                                    itemprop="url"><span itemprop="name">¿Cómo ser distribuidor?</span></a>
                            </li>
                            <li id="menu-item-21796"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21796">
                                <a href="{{ url('/corporativo/como-ser-centro-de-servicio') }}"
                                    itemprop="url"><span itemprop="name">¿Como ser centro de
                                        servicio?</span></a>
                            </li>
                            <li id="menu-item-23968"
                                class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-23968">
                                <a href="{{ url('/comunicacion/blog') }}" itemprop="url"><span
                                        itemprop="name">Mirage Blog</span></a>
                            </li>
                        </ul>
                    </li>
                    <li id="menu-item-3471"
                        class="btn-tienda menu-item menu-item-type-custom menu-item-object-custom menu-item-3471">
                        <a target="_blank" href="/tienda" itemprop="url"><span
                                itemprop="name">Tienda Mirage</span></a>
                    </li>
                    <!--
                    <li id="menu-item-35671"
                        class="btn-tienda menu-item menu-item-type-custom menu-item-object-custom menu-item-3471">
                        <a target="_blank" href="/tienda" itemprop="url">
                            @auth
                            {{ auth()->user()->name }}
                            @else
                            <span itemprop="name">Login</span>
                            @endauth
                        </a>
                    </li>

                    <li id="menu-item-35671"
                        class="btn-tienda menu-item menu-item-type-custom menu-item-object-custom menu-item-3471">
                        <a target="_blank" href="/tienda" itemprop="url"><span
                                itemprop="name">Register</span></a>
                    </li>-->

                </ul>
            </div>
        </nav>
    </div>
</header>
