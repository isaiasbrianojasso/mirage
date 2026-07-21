<div class="widget-area footer-widgets-2 footer-widget-area" style="width: 100%; max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <section class="widget_text widget widget_custom_html">
        <div class="widget_text widget-wrap">
            <h3 class="widgettitle widget-title" style="color: #ffffff; text-transform: uppercase; font-weight: bold; margin-bottom: 20px;">{{\App\Models\CompanySetting::get('company_name', 'Nuestra Empresa')}}</h3>
            <div class="textwidget custom-html-widget" style="color: #d1d5db; line-height: 1.6;">
                <p>Somos la principal marca mexicana de aires acondicionados tipo minisplit, líder nacional en ventas.</p>
                <p>Ampliamos nuestra gama de productos introduciendo componentes de <a href="/catalogo/todo/linea-blanca" style="color: #ffffff; font-weight: bold;">LINEA BLANCA</a> que integran los mismos estándares de eficiencia en ahorro energético logrados con nuestros diseños exclusivos, los modelos de la linea <strong style="color: #ffffff;">MAGNUM</strong>.</p>
                <div class="su-spacer" style="height:20px"></div>
                <img src="{{ asset('vendor/mirage-assets/wp-content/uploads/2020/06/centro_logistico_mirage-1024x464.jpg') }}" alt="{{\App\Models\CompanySetting::get('company_name', 'Nuestra Empresa')}}" class="wp-image-20305" style="width: 100%; max-width: 800px; border-radius: 4px;" />
                <div class="su-spacer" style="height:20px"></div>
                
                {{-- Iteración dinámica de Novedades (Posts) --}}
                @foreach(\App\Models\Post::where('status', 'published')->get() as $novedad)
                    <div class="su-divider su-divider-style-default" style="margin:25px 0; border-top: 2px solid #ffffff; width: 100%;"></div>
                    <h5 style="color: #ffffff; font-size: 1.25rem; font-weight: bold; margin-bottom: 10px;">{{ $novedad->title }}</h5>
                    <div style="color: #d1d5db;">{!! $novedad->content !!}</div>
                @endforeach
            </div>
        </div>
    </section>
</div>
