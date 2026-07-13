<div class="footer-widgets" id="genesis-footer-widgets">
    <h2 class="genesis-sidebar-title screen-reader-text">Footer</h2>
    <div class="wrap">
        <div class="widget-area footer-widgets-1 footer-widget-area">
            <section id="custom_html-2" class="widget_text widget widget_custom_html">
                <div class="widget_text widget-wrap">
                    <div class="textwidget custom-html-widget">
                        <h4>Soporte</h4>

                        <ul>
                            <li><a href="/corporativo/preguntas-frecuentes/">Preguntas Frecuentes</a></li>
                            <li><a href="https://www.registratuequipo.com/">Registro de equipos</a></li>
                            <li><a href="/ubicaciones/centros-de-servicio/">Centros de Servicio</a></li>
                        </ul>

                        <p>
                            <div class="su-divider su-divider-style-default"
                                style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                        </p>

                        <h4>Aplicaciones M&oacute;viles</h4>

                        <ul>
                            <li><a href="/apps/wifi-app/">App de Control WiFi</a></li>
                            <li><a href="/apps/mirage-home/">Mirage Home</a></li>
                            <li><a href="http://www.mirage.mx/apps/codigos-de-diagnostico/">C&oacute;digos de Diagn&oacute;stico</a></li>
                        </ul>

                        <p>
                            <div class="su-divider su-divider-style-default"
                                style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                        </p>

                        <h4>Corporativo</h4>

                        <ul>
                            <li><a href="http://www.mirage.mx/corporativo/semblanza-empresarial/">Semblanza Empresarial</a></li>
                            <li><a href="http://www.mirage.mx/corporativo/certificaciones/">Certificaciones</a></li>
                            <li><a href="http://www.mirage.mx/corporativo/infraestructura-operativa/">Infraestructura Operativa</a></li>
                            <li><a href="http://www.mirage.mx/corporativo/infraestructura-tecnologica/">Infraestructura Tecnol&oacute;gica</a></li>
                            <li><a href="{{ \App\Models\CompanySetting::get('online_store_url', 'http://www.tiendamirage.mx') }}">Tienda en linea</a></li>
                        </ul>

                        <p>
                            <div class="su-divider su-divider-style-default"
                                style="margin:15px 0;border-width:3px;border-color:#ffffff"><a href="#"
                                    style="color:#ffffff">Ir arriba</a></div>
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <div class="widget-area footer-widgets-2 footer-widget-area">
            @include('templates.pantalla-principal.novedades')
        </div>
        <div class="widget-area footer-widgets-3 footer-widget-area">
            <section id="custom_html-8" class="widget_text widget widget_custom_html">
                <div class="widget_text widget-wrap">
                    <h3 class="widgettitle widget-title">Corporativo Nacional</h3>
                    <div class="textwidget custom-html-widget">
                        @foreach(\App\Models\Location::where('is_active', true)->get() as $index => $location)
                            @if($index > 0)
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                            @endif
                            <h5>{{ $location->name }}</h5>
                            <p>{{ collect([$location->address, $location->city, $location->state, $location->country])->filter()->implode(', ') }}{{ $location->zip ? ' C.P. ' . $location->zip : '' }}{{ $location->phone ? ' - Tel ' . $location->phone : '' }}</p>
                        @endforeach
                        <div class="su-divider su-divider-style-default"
                            style="margin:15px 0;border-width:3px;border-color:#ffffff"><a href="#"
                                style="color:#ffffff">Ir arriba</a></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
    <div class="wrap">
        <div class="pagebottominfo">
            <p>&copy; Copyright {{ date('Y') }} <a href="{{ \App\Models\CompanySetting::get('company_website_url', 'http://www.mirage.mx/') }}">{{ company_name() }}</a> &middot; Todos los
                derechos reservados &middot; <a href="/avisos/aviso-de-privacidad/">Aviso de privacidad</a></p>
        </div>
        <p></p>
        <nav class="nav-secondary" aria-label="Secundario" itemscope
            itemtype="https://schema.org/SiteNavigationElement">
            <div class="wrap">
                <ul id="menu-footer-menu" class="menu genesis-nav-menu menu-secondary js-superfish">
                    <li id="menu-item-16"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16"><a
                            href="{{ \App\Models\CompanySetting::get('b2b_portal_url', 'https://b2b.mirage.mx/') }}" itemprop="url"><span itemprop="name">Centro Digital</span></a></li>
                    <li id="menu-item-17"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17"><a
                            href="{{ \App\Models\CompanySetting::get('certification_portal_url', 'https://www.certificacionmirage.com/') }}" itemprop="url"><span itemprop="name">Certificacion Mirage</span></a></li>
                    <li id="menu-item-14"
                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14"><a
                            target="_blank" href="{{ \App\Models\CompanySetting::get('social_facebook', 'https://www.facebook.com/miragemx') }}" itemprop="url"><span itemprop="name">Facebook</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
</footer>
