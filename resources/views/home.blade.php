
@include('components.x-header')
<body
    class="home wp-singular page-template-default page page-id-821 wp-theme-genesis wp-child-theme-digital-pro theme-genesis woocommerce-no-js custom-header header-image header-full-width full-width-content genesis-title-hidden genesis-breadcrumbs-hidden genesis-footer-widgets-visible elementor-default elementor-kit-23667 front-page front-page-loop"
    itemscope itemtype="https://schema.org/WebPage">
    
    <div class="site-container">
    @include('components.x-menu')
        <div data-elementor-type="container" data-elementor-id="23732" class="elementor elementor-23732"
            data-elementor-post-type="elementor_library">
            <div class="elementor-element elementor-element-1f324697 e-con-full e-flex e-con e-parent"
                data-id="1f324697" data-element_type="container" data-e-type="container">
                <div class="elementor-element elementor-element-4c8447be e-flex e-con-boxed e-con e-child"
                    data-id="4c8447be" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-3cc77086 e-con-full e-flex e-con e-child"
                            data-id="3cc77086" data-element_type="container" data-e-type="container">
                            <div class="elementor-element elementor-element-3dc87701 elementor-widget elementor-widget-spacer"
                                data-id="3dc87701" data-element_type="widget" data-e-type="widget"
                                data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-element elementor-element-822efad elementor-headline--style-rotate elementor-widget elementor-widget-animated-headline"
                                data-id="822efad" data-element_type="widget" data-e-type="widget"
                                data-settings="{&quot;rotating_text&quot;:&quot;INVERTER\nMODERNA\nCONFIABLE&quot;,&quot;headline_style&quot;:&quot;rotate&quot;,&quot;animation_type&quot;:&quot;slide&quot;,&quot;loop&quot;:&quot;yes&quot;,&quot;rotate_iteration_delay&quot;:2500}"
                                data-widget_type="animated-headline.default">
                                <div class="elementor-widget-container">
                                    <h3 class="elementor-headline elementor-headline-animation-type-slide">
                                        <span
                                            class="elementor-headline-plain-text elementor-headline-text-wrapper">{{ \App\Models\CompanySetting::get('home_banner_title_fixed', 'TECNOLOGÍA') }}</span>
                                        <span
                                            class="elementor-headline-dynamic-wrapper elementor-headline-text-wrapper">
                                            @php
                                                $dynamicTexts = explode(',', \App\Models\CompanySetting::get('home_banner_title_dynamic', 'INVERTER,MODERNA,CONFIABLE'));
                                            @endphp
                                            @foreach($dynamicTexts as $index => $text)
                                            <span
                                                class="elementor-headline-dynamic-text {{ $index === 0 ? 'elementor-headline-text-active' : '' }}">
                                                {{ trim($text) }} </span>
                                            @endforeach
                                        </span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-a22619c e-flex e-con-boxed e-con e-child"
                            data-id="a22619c" data-element_type="container" data-e-type="container">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-7c2a0e47 elementor-widget elementor-widget-image"
                                    data-id="7c2a0e47" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img fetchpriority="high" width="1210" height="783"
                                            src="{{ \App\Models\CompanySetting::get('home_banner_main_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/mirage_magnum22.webp')) }}"
                                            class="attachment-full size-full wp-image-23692" alt=""
                                            srcset="{{ \App\Models\CompanySetting::get('home_banner_main_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/mirage_magnum22.webp')) }} 1210w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/mirage_magnum22-300x194.webp') }} 300w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/mirage_magnum22-1024x663.webp') }} 1024w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/mirage_magnum22-768x497.webp') }} 768w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/mirage_magnum22-670x434.webp') }} 670w"
                                            sizes="(max-width: 1210px) 100vw, 1210px" /> </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-3735e9f6 e-grid e-con-boxed e-con e-child"
                            data-id="3735e9f6" data-element_type="container" data-e-type="container"
                            data-settings="{&quot;motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_effect&quot;:&quot;yes&quot;,&quot;motion_fx_translateY_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:4,&quot;sizes&quot;:[]},&quot;motion_fx_translateY_affectedRange&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:0,&quot;end&quot;:100}},&quot;motion_fx_devices&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;]}">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-5a5b1ae5 elementor-tablet-position-inline-end elementor-view-default elementor-position-block-start elementor-mobile-position-block-start elementor-widget elementor-widget-icon-box"
                                    data-id="5a5b1ae5" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-box-wrapper">

                                            <div class="elementor-icon-box-icon">
                                                <a href="{{ \App\Models\CompanySetting::get('home_banner_info_url', 'https://mirage.mx/productos/todo/aire-acondicionado/minisplit/inverter/magnum-22-inverter/') }}"
                                                    class="elementor-icon" tabindex="-1">
                                                    <i aria-hidden="true" class="fas fa-info-circle"></i> </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-7de0e952 elementor-view-default elementor-position-block-start elementor-mobile-position-block-start elementor-widget elementor-widget-icon-box"
                                    data-id="7de0e952" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-icon-box-wrapper">

                                            <div class="elementor-icon-box-icon">
                                                <a href="{{ \App\Models\CompanySetting::get('home_banner_cart_url', url('/ubicaciones')) }}"
                                                    class="elementor-icon" tabindex="-1">
                                                    <i aria-hidden="true" class="fas fa-shopping-cart"></i> </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-6aa951de elementor-widget elementor-widget-spacer"
                            data-id="6aa951de" data-element_type="widget" data-e-type="widget"
                            data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-5fbfb193 e-flex e-con-boxed e-con e-child"
                    data-id="5fbfb193" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-1302c606 e-flex e-con-boxed e-con e-child"
                            data-id="1302c606" data-element_type="container" data-e-type="container"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-5fa3a384 elementor-widget elementor-widget-image"
                                    data-id="5fa3a384" data-element_type="widget" data-e-type="widget"
                                    data-settings="{&quot;sticky&quot;:&quot;bottom&quot;,&quot;sticky_on&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;],&quot;sticky_offset&quot;:0,&quot;sticky_effects_offset&quot;:0,&quot;sticky_anchor_link_offset&quot;:0}"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <img fetchpriority="high"
                                            src="{{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/followme_cover.webp') }}"
                                            title="{{ \App\Models\CompanySetting::get('home_video_title', 'Función Sígueme') }}" alt="{{ \App\Models\CompanySetting::get('home_video_title', 'Función Sígueme') }}" /> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-4c4de495 e-con-full e-flex e-con e-child"
                    data-id="4c4de495" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;background_motion_fx_motion_fx_scrolling&quot;:&quot;yes&quot;,&quot;background_motion_fx_scale_effect&quot;:&quot;yes&quot;,&quot;background_motion_fx_scale_direction&quot;:&quot;in-out&quot;,&quot;background_motion_fx_scale_speed&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:4,&quot;sizes&quot;:[]},&quot;background_motion_fx_scale_range&quot;:{&quot;unit&quot;:&quot;%&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:{&quot;start&quot;:20,&quot;end&quot;:80}},&quot;background_motion_fx_devices&quot;:[&quot;desktop&quot;,&quot;tablet&quot;,&quot;mobile&quot;]}">
                    <div class="elementor-element elementor-element-042eac0 elementor-widget elementor-widget-spacer"
                        data-id="042eac0" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-9e20854 elementor-widget elementor-widget-ucaddon_blox_play_button"
                        data-id="9e20854" data-element_type="widget" data-e-type="widget"
                        data-widget_type="ucaddon_blox_play_button.default">
                        <div class="elementor-widget-container">

                            <!-- start Video Play Button -->
                            <link id='font-awesome-css'
                                href="{{ asset('vendor/mirage-assets/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/font-awesome6/fontawesome-all.min.css') }}"
                                type='text/css' rel='stylesheet'>
                            <link id='font-awesome-4-shim-css'
                                href="{{ asset('vendor/mirage-assets/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/font-awesome6/fontawesome-v4-shims.min.css') }}"
                                type='text/css' rel='stylesheet'>
                            <link id='lity-css'
                                href="{{ asset('vendor/mirage-assets/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/lity/lity.min.css') }}"
                                type='text/css' rel='stylesheet'>

                            <style>
                                /* widget: Video Play Button */

                                #uc_blox_play_button_elementor_9e20854 {
                                    width: 100%;
                                }

                                .container_uc_blox_play_button_elementor_9e20854 {
                                    display: flex;
                                    justify-content: center;
                                }

                                #uc_blox_play_button_elementor_9e20854 a {
                                    display: inline-block;
                                    transition: 0.5s;
                                    text-decoration: none;
                                }

                                .ue_play_button {
                                    text-align: center;
                                }

                                #uc_blox_play_button_elementor_9e20854 a:hover {
                                    transform: scale(1.1, 1.1);
                                }

                                #uc_blox_play_button_elementor_9e20854 a span.video-button {
                                    display: inline-block;
                                    align-items: center;
                                    justify-content: center;
                                    flex-direction: column;
                                    display: flex;
                                    position: relative;
                                    transition: 0.3s;
                                    line-height: 1em;
                                }

                                .ue-play-bg {
                                    background-size: cover;
                                    background-position: center;
                                    background-repeat: none;
                                    max-width: 100%;
                                }

                                #uc_blox_play_button_elementor_9e20854 a span.video-button svg {
                                    height: 1em;
                                    width: 1em;
                                }

                                #uc_blox_play_button_elementor_9e20854 i {

                                    vertical-align: middle;
                                    transition: 0.3s;
                                }

                                #uc_blox_play_button_elementor_9e20854 a span:before {
                                    content: '';
                                    display: inline-block;
                                    position: absolute;
                                    top: -2px;
                                    left: -2px;
                                    bottom: -2px;
                                    right: -2px;
                                    border-radius: inherit;
                                    border: 1px solid #000000;
                                    -webkit-animation: btnIconRipple 2s cubic-bezier(0.23, 1, 0.32, 1) both infinite;
                                    animation: btnIconRipple 2s cubic-bezier(0.23, 1, 0.32, 1) both infinite;
                                    border-color: #000000;
                                }

                                @keyframes btnIconRipple {
                                    0% {
                                        border-width: 4px;
                                        transform: scale(1);
                                    }

                                    80% {
                                        border-width: 1px;
                                        transform: scale(1.35);
                                    }

                                    100% {
                                        opacity: 0;
                                    }
                                }












                                .button_uc_blox_play_button_elementor_9e20854 {
                                    animation: ue-video-popup-waggle 5s infinite;
                                }

                                @keyframes ue-video-popup-waggle {
                                    0% {
                                        transform: none;
                                    }

                                    10% {
                                        transform: rotateZ(-20deg) scale(1.2);
                                    }

                                    13% {
                                        transform: rotateZ(25deg) scale(1.2);
                                    }

                                    15% {
                                        transform: rotateZ(-15deg) scale(1.2);
                                    }

                                    17% {
                                        transform: rotateZ(15deg) scale(1.2);
                                    }

                                    20% {
                                        transform: rotateZ(-12deg) scale(1.2);
                                    }

                                    22% {
                                        transform: rotateZ(0) scale(1.2);
                                    }

                                    25%,
                                    100% {
                                        transform: rotateZ(0) scale(1);
                                    }
                                }
                            </style>

                            <div id="uc_blox_play_button_elementor_9e20854" class="ue_play_button"
                                data-path="self_hosted">
                                <a href="{{ \App\Models\CompanySetting::get('home_video_url', 'https://c5k4h6e2.rocketcdn.me/wp-content/uploads/2023/04/magnum22_720p@2mbps.mp4') }}"
                                    class="button_uc_blox_play_button_elementor_9e20854" data-lity>
                                    <span class="video-button">
                                        <i class='fas fa-play'></i>
                                    </span>
                                </a>
                            </div>

                            <!-- end Video Play Button -->
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-fae21c1 elementor-widget elementor-widget-spacer"
                        data-id="fae21c1" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-037944a e-flex e-con-boxed e-con e-child"
                    data-id="037944a" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="e-con-inner">
                        <div class="elementor-element elementor-element-6b47a5d elementor-widget elementor-widget-spacer"
                            data-id="6b47a5d" data-element_type="widget" data-e-type="widget"
                            data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner"></div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-23962cf e-con-full e-flex e-con e-child"
                            data-id="23962cf" data-element_type="container" data-e-type="container">
                            <div class="elementor-element elementor-element-9b82e7c e-con-full e-grid e-con e-child"
                                data-id="9b82e7c" data-element_type="container" data-e-type="container">
                                <div class="elementor-element elementor-element-6382ffb elementor-widget elementor-widget-image"
                                    data-id="6382ffb" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <a href="{{ \App\Models\CompanySetting::get('home_cat1_url', '//mirage.mx/catalogo/todo/aire-acondicionado/minisplit/on-off/') }}">
                                            <img width="563" height="679"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20563%20679'%3E%3C/svg%3E"
                                                class="attachment-full size-full wp-image-23697" alt=""
                                                data-lazy-srcset="{{ \App\Models\CompanySetting::get('home_category_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp')) }} 563w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_convencionales_mirage-249x300.webp') }} 249w"
                                                data-lazy-sizes="(max-width: 563px) 100vw, 563px"
                                                data-lazy-src="{{ \App\Models\CompanySetting::get('home_category_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp')) }}" /><noscript><img
                                                    width="563" height="679"
                                                    src="{{ \App\Models\CompanySetting::get('home_category_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp')) }}"
                                                    class="attachment-full size-full wp-image-23697" alt=""
                                                    srcset="{{ \App\Models\CompanySetting::get('home_category_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp')) }} 563w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_convencionales_mirage-249x300.webp') }} 249w"
                                                    sizes="(max-width: 563px) 100vw, 563px" /></noscript> </a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-9f532ac elementor-widget elementor-widget-image"
                                    data-id="9f532ac" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <a href="{{ \App\Models\CompanySetting::get('home_cat2_url', '//mirage.mx/catalogo/todo/aire-acondicionado/comercial-ligero/') }}">
                                            <img width="563" height="679"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20563%20679'%3E%3C/svg%3E"
                                                class="attachment-full size-full wp-image-23698" alt=""
                                                data-lazy-srcset="{{ \App\Models\CompanySetting::get('home_category_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp')) }} 563w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage-249x300.webp') }} 249w"
                                                data-lazy-sizes="(max-width: 563px) 100vw, 563px"
                                                data-lazy-src="{{ \App\Models\CompanySetting::get('home_category_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp')) }}" /><noscript><img
                                                    loading="lazy" width="563" height="679"
                                                    src="{{ \App\Models\CompanySetting::get('home_category_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp')) }}"
                                                    class="attachment-full size-full wp-image-23698" alt=""
                                                    srcset="{{ \App\Models\CompanySetting::get('home_category_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp')) }} 563w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage-249x300.webp') }} 249w"
                                                    sizes="(max-width: 563px) 100vw, 563px" /></noscript> </a>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-1f5ce5c elementor-widget elementor-widget-image"
                                    data-id="1f5ce5c" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                        <a href="{{ \App\Models\CompanySetting::get('home_cat3_url', '//mirage.mx/catalogo/todo/linea-blanca/') }}">
                                            <img width="563" height="679"
                                                src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%20563%20679'%3E%3C/svg%3E"
                                                class="attachment-full size-full wp-image-23699" alt=""
                                                data-lazy-srcset="{{ \App\Models\CompanySetting::get('home_category_3_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/linea_blanca_mirage.webp')) }} 563w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/linea_blanca_mirage-249x300.webp') }} 249w"
                                                data-lazy-sizes="(max-width: 563px) 100vw, 563px"
                                                data-lazy-src="{{ \App\Models\CompanySetting::get('home_category_3_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/linea_blanca_mirage.webp')) }}" /><noscript><img
                                                    loading="lazy" width="563" height="679"
                                                    src="{{ \App\Models\CompanySetting::get('home_category_3_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/linea_blanca_mirage.webp')) }}"
                                                    class="attachment-full size-full wp-image-23699" alt=""
                                                    srcset="{{ \App\Models\CompanySetting::get('home_category_3_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/linea_blanca_mirage.webp')) }} 563w, {{ asset('vendor/mirage-assets/wp-content/uploads/2023/07/linea_blanca_mirage-249x300.webp') }} 249w"
                                                    sizes="(max-width: 563px) 100vw, 563px" /></noscript> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-f707f02 e-con-full e-flex e-con e-child"
                    data-id="f707f02" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-element elementor-element-ab7ff4b elementor-widget elementor-widget-spacer"
                        data-id="ab7ff4b" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-5247561 e-con-full e-flex e-con e-child"
                        data-id="5247561" data-element_type="container" data-e-type="container">
                        <div class="elementor-element elementor-element-43b4861 e-grid e-con-boxed e-con e-child"
                            data-id="43b4861" data-element_type="container" data-e-type="container">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-d61b81e elementor-flip-box--effect-flip elementor-flip-box--direction-up elementor-widget elementor-widget-flip-box"
                                    data-id="d61b81e" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="flip-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-flip-box" tabindex="0">
                                            <div class="elementor-flip-box__layer elementor-flip-box__front">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <div class="elementor-icon-wrapper elementor-view-default">
                                                            <div class="elementor-icon">
                                                                <i aria-hidden="true" class="fas fa-tools"></i> </div>
                                                        </div>

                                                        <h3 class="elementor-flip-box__layer__title">
                                                            {{ \App\Models\CompanySetting::get('home_info_install_title', 'Sobre la instalación') }} </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            {{ \App\Models\CompanySetting::get('home_info_install_desc', 'Si compró su equipo en una tienda departamental o de autoservicio que incluía el servicio de instalación gratis') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-flip-box__layer elementor-flip-box__back">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <h3 class="elementor-flip-box__layer__title">
                                                            {{ \App\Models\CompanySetting::get('home_info_install_back_title', 'Programe su visita') }} </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            {{ company('installation_service_url', 'https://www.instalamirage.com') }} </div>

                                                        <a class="elementor-flip-box__button elementor-button elementor-size-sm"
                                                            href="{{ company('installation_service_url', 'https://www.instalamirage.com') }}">
                                                            {{ \App\Models\CompanySetting::get('home_info_install_btn', 'Clic Aquí') }} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-a03f919 elementor-flip-box--effect-flip elementor-flip-box--direction-up elementor-widget elementor-widget-flip-box"
                                    data-id="a03f919" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="flip-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-flip-box" tabindex="0">
                                            <div class="elementor-flip-box__layer elementor-flip-box__front">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <div class="elementor-icon-wrapper elementor-view-default">
                                                            <div class="elementor-icon">
                                                                <i aria-hidden="true" class="fas fa-diagnoses"></i>
                                                            </div>
                                                        </div>

                                                        <h3 class="elementor-flip-box__layer__title">
                                                            {{ \App\Models\CompanySetting::get('home_info_warranty_title', 'Garantía y Soporte') }} </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            {{ \App\Models\CompanySetting::get('home_info_warranty_desc', 'El departamento de garantías atiende las reclamaciones a través de los centros de servicio de los distribuidores.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-flip-box__layer elementor-flip-box__back">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <h3 class="elementor-flip-box__layer__title">
                                                            {{ \App\Models\CompanySetting::get('home_info_warranty_back_title', 'Inicie una solicitud de servicio') }} </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            {{ \App\Models\CompanySetting::get('home_info_warranty_back_desc', 'Por favor dé "clic" en el siguiente botón y complete el formulario.') }} </div>

                                                        <a class="elementor-flip-box__button elementor-button elementor-size-sm"
                                                            href="https://b2b.mirage.mx/defaultv1.aspx?_m_=POSTVENTAFP1&#038;d=SX1&#038;tt=3D7FC03E-EBF1-471D-9105-B337AA1BFC35">
                                                            {{ \App\Models\CompanySetting::get('home_info_warranty_btn', 'Clic Aquí') }} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="elementor-element elementor-element-72620e4 elementor-flip-box--effect-flip elementor-flip-box--direction-up elementor-widget elementor-widget-flip-box"
                                    data-id="72620e4" data-element_type="widget" data-e-type="widget"
                                    data-widget_type="flip-box.default">
                                    <div class="elementor-widget-container">
                                        <div class="elementor-flip-box" tabindex="0">
                                            <div class="elementor-flip-box__layer elementor-flip-box__front">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <div class="elementor-icon-wrapper elementor-view-default">
                                                            <div class="elementor-icon">
                                                                <i aria-hidden="true" class="fas fa-map-marked-alt"></i>
                                                            </div>
                                                        </div>

                                                        <h3 class="elementor-flip-box__layer__title">
                                                            {{ \App\Models\CompanySetting::get('home_info_location_title', '¿Dónde estamos?') }} </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            {{ \App\Models\CompanySetting::get('home_info_location_desc', 'Contamos con varios almacenes de distribucion de fábrica, tiendas oficiales, puntos de venta y centros de servicio.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-flip-box__layer elementor-flip-box__back">
                                                <div class="elementor-flip-box__layer__overlay">
                                                    <div class="elementor-flip-box__layer__inner">
                                                        <h3 class="elementor-flip-box__layer__title">
                                                            {{ \App\Models\CompanySetting::get('home_info_location_back_title', 'Localízenos') }} </h3>

                                                        <div class="elementor-flip-box__layer__description">
                                                            {!! \App\Models\CompanySetting::get('home_info_location_back_desc', 'Puede encontrar ayuda en nuestro directorio de ubicaciones para <a href="//mirage.mx/ubicaciones/tiendas-oficiales/" style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Tiendas Oficiales</a>, <a href="//mirage.mx/ubicaciones/distribuidores/" style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Distribuidores Mayoristas</a> y <a href="//mirage.mx/ubicaciones/centros-de-servicio/" style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Centros de Servicio</a>.') !!} </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-c686b0f elementor-widget elementor-widget-spacer"
                        data-id="c686b0f" data-element_type="widget" data-e-type="widget"
                        data-widget_type="spacer.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-spacer">
                                <div class="elementor-spacer-inner"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-element elementor-element-7903df13 e-con-full e-flex e-con e-child"
                    data-id="7903df13" data-element_type="container" data-e-type="container"
                    data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-element elementor-element-8fba461 elementor-widget elementor-widget-shortcode"
                        data-id="8fba461" data-element_type="widget" data-e-type="widget"
                        data-widget_type="shortcode.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-shortcode">
                                <div class="su-image-carousel fpb-carousel su-image-carousel-columns-2 su-image-carousel-adaptive su-image-carousel-slides-style-minimal su-image-carousel-controls-style-light su-image-carousel-align-center"
                                    style="max-width:2560px"
                                    data-flickity-options='{"groupCells":true,"cellSelector":".su-image-carousel-item","adaptiveHeight":true,"cellAlign":"left","prevNextButtons":true,"pageDots":false,"autoPlay":15000,"imagesLoaded":true,"contain":false,"selectedAttraction":0.025000000000000001387778780781445675529539585113525390625,"friction":0.2800000000000000266453525910037569701671600341796875}'
                                    id="su_image_carousel_6a316b792df5d">
                                    <div class="su-image-carousel-item">
                                        <div class="su-image-carousel-item-content"><a
                                                href="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_url', \App\Models\CompanySetting::get('home_specialists_url', 'https://especialistas.mirage.mx')) }}" target="_blank"
                                                rel="noopener noreferrer" data-caption=""><img width="1135" height="738"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201135%20738'%3E%3C/svg%3E"
                                                    class="" alt="" decoding="async"
                                                    data-lazy-srcset="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/especialistas_mirage_web.webp')) }} 1135w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/especialistas_mirage_web.webp')) }}" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/especialistas_mirage_web.webp')) }}"
                                                        class="" alt="" decoding="async"
                                                        srcset="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/especialistas_mirage_web.webp')) }} 1135w"
                                                        sizes="(max-width: 1135px) 100vw, 1135px" /></noscript></a>
                                        </div>
                                    </div>
                                    <div class="su-image-carousel-item">
                                        <div class="su-image-carousel-item-content"><a
                                                href="{{ \App\Models\CompanySetting::get('home_bottom_banner_2_url', 'mailto:' . \App\Models\CompanySetting::get('contact_email', 'contacto@empresa.com')) }}" target="_blank"
                                                rel="noopener noreferrer" data-caption=""><img width="1135" height="738"
                                                    src="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%201135%20738'%3E%3C/svg%3E"
                                                    class="" alt="" decoding="async"
                                                    data-lazy-srcset="{{ \App\Models\CompanySetting::get('home_bottom_banner_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/oportunidades_mirage.webp')) }} 1135w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="{{ \App\Models\CompanySetting::get('home_bottom_banner_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/oportunidades_mirage.webp')) }}" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="{{ \App\Models\CompanySetting::get('home_bottom_banner_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/oportunidades_mirage.webp')) }}"
                                                        class="" alt="" decoding="async"
                                                        srcset="{{ \App\Models\CompanySetting::get('home_bottom_banner_2_image', asset('vendor/mirage-assets/wp-content/uploads/2023/07/oportunidades_mirage.webp')) }} 1135w"
                                                        sizes="(max-width: 1135px) 100vw, 1135px" /></noscript></a>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript" id="su_image_carousel_6a316b792df5d_script">
                                    if(window.SUImageCarousel){setTimeout(function() {window.SUImageCarousel.initGallery(document.getElementById("su_image_carousel_6a316b792df5d"))}, 0);}var su_image_carousel_6a316b792df5d_script=document.getElementById("su_image_carousel_6a316b792df5d_script");if(su_image_carousel_6a316b792df5d_script){su_image_carousel_6a316b792df5d_script.parentNode.removeChild(su_image_carousel_6a316b792df5d_script);}
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="screen-reader-text">Contenido Principal</h2>
        <div id="front-page-2" class="front-page-2">
            <div class="wrap">
                <div class="flexible-widgets widget-area fadeup-effect widget-full"></div>
            </div>
        </div>
        <div data-wpr-lazyrender="1" class="site-inner">
            <div class="content-sidebar-wrap">
                <main class="content" id="genesis-content"></main>
            </div>
        </div>
        @include('components.x-legacy-footer')
    <script type="speculationrules">
        {"prefetch":[{"source":"document","where":{"and":[{"href_matches":"/*"},{"not":{"href_matches":["/wp-*.php","/wp-admin/*","/wp-content/uploads/*","/wp-content/*","/wp-content/plugins/*","/wp-content/themes/digital-pro/*","/wp-content/themes/genesis/*","/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
    <!-- Load Facebook SDK for JavaScript -->
    <div data-wpr-lazyrender="1" id="fb-root"></div>
    <script type="text/javascript">(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!-- Your customer chat code -->
    <div class="fb-customerchat" attribution=install_email page_id="135782736455828"
        logged_in_greeting="¡Hola! ¿En qué te podemos ayudar?" logged_out_greeting="¡Hola! ¿En qué te podemos ayudar?">
    </div>
    <script type="text/javascript">
        (function($){
  $(window).on('elementor/frontend/init', function() {

    function ensureDownloadButton($lightbox){
      let $btn = $lightbox.find('.elementor-download-wrap a.elementor-download-btn');
      if ($btn.length) return $btn;

      let $block = $(`
        <div class="elementor-download-wrap">
          <a class="elementor-download-btn"
             href="#"
             data-elementor-open-lightbox="no"
             rel="noopener noreferrer">
             Descargar
          </a>
        </div>
      `);

      let $content = $lightbox.find('.elementor-lightbox-content');
      ($content.length ? $content : $lightbox).append($block);

      return $block.find('a');
    }

    function setHref($btn, url){
      if (!url) return;
      // Guardamos la URL en un atributo propio
      $btn.attr('data-dl-url', url);
    }

    // --- CLICK DEL BOTÓN DE DESCARGA ---
    $(document).on('click', '.elementor-download-btn', function(e){
      e.preventDefault();
      e.stopPropagation();

      let url = $(this).attr('data-dl-url');
      if (!url) return;

      // Fuerza descarga creando un <a download> temporal
      let a = document.createElement('a');
      a.href = url;
      a.setAttribute('download', ''); // descarga con nombre original
      document.body.appendChild(a);
      a.click();
      a.remove();
    });

    // --- CUANDO SE ABRE EL LIGHTBOX ---
    $(document).on('click', '[data-elementor-open-lightbox="yes"], .elementor-lightbox-item', function(){
      let $trigger = $(this);

      // Buscamos el widget padre (Imagen, Galería o Media Carousel)
      let $widget = $trigger.closest(
        '.elementor-widget-image, .elementor-widget-gallery, .elementor-widget-media-carousel'
      );

      let customUrl = $widget.attr('data-download-url') || null;

      setTimeout(function(){
        let $lightbox  = $('.elementor-lightbox');
        let $img       = $lightbox.find('.elementor-lightbox-image');
        let defaultUrl = $img.attr('src');

        let $btn = ensureDownloadButton($lightbox);
        setHref($btn, customUrl || defaultUrl);

        // Observa cambios en la imagen del lightbox (desde flechas)
        if (!$lightbox.data('dlObserver')) {
          let obs = new MutationObserver(function(){
            let currentSrc = $lightbox.find('.elementor-lightbox-image').attr('src');
            setHref($btn, currentSrc);
          });

          let imgEl = $img.get(0);
          if (imgEl) {
            obs.observe(imgEl, { attributes: true, attributeFilter: ['src'] });
            $lightbox.data('dlObserver', obs);
          }
        }
      }, 50);
    });

  });
})(jQuery);
</script>
    <style type="text/css" media="screen"></style>
    <script type="text/javascript">
        const lazyloadRunObserver = () => {
					const lazyloadBackgrounds = document.querySelectorAll( `.e-con.e-parent:not(.e-lazyloaded)` );
					const lazyloadBackgroundObserver = new IntersectionObserver( ( entries ) => {
						entries.forEach( ( entry ) => {
							if ( entry.isIntersecting ) {
								let lazyloadBackground = entry.target;
								if( lazyloadBackground ) {
									lazyloadBackground.classList.add( 'e-lazyloaded' );
								}
								lazyloadBackgroundObserver.unobserve( entry.target );
							}
						});
					}, { rootMargin: '200px 0px 200px 0px' } );
					lazyloadBackgrounds.forEach( ( lazyloadBackground ) => {
						lazyloadBackgroundObserver.observe( lazyloadBackground );
					} );
				};
				const events = [
					'DOMContentLoaded',
					'elementor/lazyload/observe',
				];
				events.forEach( ( event ) => {
					document.addEventListener( event, lazyloadRunObserver );
				} );
			</script>
    <script type="text/javascript" data-rocket-type='text/javascript'>
        (function () {
			var c = document.body.className;
			c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
			document.body.className = c;
		})();
	</script>
    <link rel='stylesheet' id='wc-blocks-style-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks.css') }}"
        media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/css/frontend.min.css') }}" media='all' />
    <link rel='stylesheet' id='elementor-post-23732-css'
        href="{{ asset('vendor/mirage-assets/wp-content/uploads/elementor/css/post-23732.css') }}" media='all' />
    <link rel='stylesheet' id='widget-spacer-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/css/widget-spacer.min.css') }}" media='all' />
    <link rel='stylesheet' id='widget-animated-headline-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/css/widget-animated-headline.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='widget-image-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/css/widget-image.min.css') }}" media='all' />
    <link rel='stylesheet' id='widget-icon-box-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='e-motion-fx-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/css/modules/motion-fx.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='e-sticky-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/css/modules/sticky.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='widget-flip-box-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/css/widget-flip-box.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='flickity-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/shortcodes-ultimate/vendor/flickity/flickity.css') }}"
        media='all' />
    <link rel='stylesheet' id='su-shortcodes-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/shortcodes-ultimate/includes/css/shortcodes.css') }}"
        media='all' />
    <link rel='stylesheet' id='elementor-icons-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='elementor-post-23667-css'
        href="{{ asset('vendor/mirage-assets/wp-content/uploads/elementor/css/post-23667.css') }}" media='all' />
    <link rel='stylesheet' id='elementor-gf-local-roboto-css'
        href="{{ asset('vendor/mirage-assets/wp-content/uploads/elementor/google-fonts/css/roboto.css') }}" media='all' />
    <link rel='stylesheet' id='elementor-gf-local-robotoslab-css'
        href="{{ asset('vendor/mirage-assets/wp-content/uploads/elementor/google-fonts/css/robotoslab.css') }}"
        media='all' />
    <link rel='stylesheet' id='elementor-icons-shared-0-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/lib/font-awesome/css/fontawesome.min.css') }}"
        media='all' />
    <link rel='stylesheet' id='elementor-icons-fa-solid-css'
        href="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css') }}"
        media='all' />
    <script id="woocommerce-events-front-script-js-extra">
        var frontObj = {
            "copyFromPurchaser": "autocopy"
        };
        //# sourceURL=woocommerce-events-front-script-js-extra
    </script>
    <script type="text/javascript" id="woocommerce-events-front-script-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/fooevents/js/events-frontend.js') }}"
         defer></script>
    <script type="text/javascript" id="rocket-browser-checker-js-after">
        "use strict";var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var RocketBrowserCompatibilityChecker=function(){function RocketBrowserCompatibilityChecker(options){_classCallCheck(this,RocketBrowserCompatibilityChecker),this.passiveSupported=!1,this._checkPassiveOption(this),this.options=!!this.passiveSupported&&options}return _createClass(RocketBrowserCompatibilityChecker,[{key:"_checkPassiveOption",value:function(self){try{var options={get passive(){return!(self.passiveSupported=!0)}};window.addEventListener("test",null,options),window.removeEventListener("test",null,options)}catch(err){self.passiveSupported=!1}}},{key:"initRequestIdleCallback",value:function(){!1 in window&&(window.requestIdleCallback=function(cb){var start=Date.now();return setTimeout(function(){cb({didTimeout:!1,timeRemaining:function(){return Math.max(0,50-(Date.now()-start))}})},1)}),!1 in window&&(window.cancelIdleCallback=function(id){return clearTimeout(id)})}},{key:"isDataSaverModeOn",value:function(){return"connection"in navigator&&!0===navigator.connection.saveData}},{key:"supportsLinkPrefetch",value:function(){var elem=document.createElement("link");return elem.relList&&elem.relList.supports&&elem.relList.supports("prefetch")&&window.IntersectionObserver&&"isIntersecting"in IntersectionObserverEntry.prototype}},{key:"isSlowConnection",value:function(){return"connection"in navigator&&"effectiveType"in navigator.connection&&("2g"===navigator.connection.effectiveType||"slow-2g"===navigator.connection.effectiveType)}}]),RocketBrowserCompatibilityChecker}();
//# sourceURL=rocket-browser-checker-js-after
</script>
    <script id="rocket-preload-links-js-extra">
        var RocketPreloadLinksConfig = {
            "excludeUris": "/wpstream/live/|/(?:.+/)?feed(?:/(?:.+/?)?)?$|/(?:.+/)?embed/|/reservar/??(.*)|/confirmar/?|/mi-cuenta/??(.*)|/(index.php/)?(.*)wp-json(/.*|$)|/refer/|/go/|/recommend/|/recommends/",
            "usesTrailingSlash": "1",
            "imageExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php",
            "fileExt": "jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php|html|htm",
            "siteUrl": "https://mirage.mx",
            "onHoverDelay": "100",
            "rateThrottle": "3"
        };
        //# sourceURL=rocket-preload-links-js-extra
    </script>
    <script type="text/javascript" id="rocket-preload-links-js-after">
        (function() {
"use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}();function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function n(e,t){i(this,n),this.browser=e,this.config=t,this.options=this.browser.options,this.prefetched=new Set,this.eventTime=null,this.threshold=1111,this.numOnHover=0}return e(n,[{key:"init",value:function(){!this.browser.supportsLinkPrefetch()||this.browser.isDataSaverModeOn()||this.browser.isSlowConnection()||(this.regex={excludeUris:RegExp(this.config.excludeUris,"i"),images:RegExp(".("+this.config.imageExt+")$","i"),fileExt:RegExp(".("+this.config.fileExt+")$","i")},this._initListeners(this))}},{key:"_initListeners",value:function(e){-1<this.config.onHoverDelay&&document.addEventListener("mouseover",e.listener.bind(e),e.listenerOptions),document.addEventListener("mousedown",e.listener.bind(e),e.listenerOptions),document.addEventListener("touchstart",e.listener.bind(e),e.listenerOptions)}},{key:"listener",value:function(e){var t=e.target.closest("a"),n=this._prepareUrl(t);if(null!==n)switch(e.type){case"mousedown":case"touchstart":this._addPrefetchLink(n);break;case"mouseover":this._earlyPrefetch(t,n,"mouseout")}}},{key:"_earlyPrefetch",value:function(t,e,n){var i=this,r=setTimeout(function(){if(r=null,0===i.numOnHover)setTimeout(function(){return i.numOnHover=0},1e3);else if(i.numOnHover>i.config.rateThrottle)return;i.numOnHover++,i._addPrefetchLink(e)},this.config.onHoverDelay);t.addEventListener(n,function e(){t.removeEventListener(n,e,{passive:!0}),null!==r&&(clearTimeout(r),r=null)},{passive:!0})}},{key:"_addPrefetchLink",value:function(i){return this.prefetched.add(i.href),new Promise(function(e,t){var n=document.createElement("link");n.rel="prefetch",n.href=i.href,n.onload=e,n.onerror=t,document.head.appendChild(n)}).catch(function(){})}},{key:"_prepareUrl",value:function(e){if(null===e||"object"!==(void 0===e?"undefined":r(e))||!1 in e||-1===["http:","https:"].indexOf(e.protocol))return null;var t=e.href.substring(0,this.config.siteUrl.length),n=this._getPathname(e.href,t),i={original:e.href,protocol:e.protocol,origin:t,pathname:n,href:t+n};return this._isLinkOk(i)?i:null}},{key:"_getPathname",value:function(e,t){var n=t?e.substring(this.config.siteUrl.length):e;return n.startsWith("/")||(n="/"+n),this._shouldAddTrailingSlash(n)?n+"/":n}},{key:"_shouldAddTrailingSlash",value:function(e){return this.config.usesTrailingSlash&&!e.endsWith("/")&&!this.regex.fileExt.test(e)}},{key:"_isLinkOk",value:function(e){return null!==e&&"object"===(void 0===e?"undefined":r(e))&&(!this.prefetched.has(e.href)&&e.origin===this.config.siteUrl&&-1===e.href.indexOf("?")&&-1===e.href.indexOf("#")&&!this.regex.excludeUris.test(e.href)&&!this.regex.images.test(e.href))}}],[{key:"run",value:function(){"undefined"!=typeof RocketPreloadLinksConfig&&new n(new RocketBrowserCompatibilityChecker({capture:!0,passive:!0}),RocketPreloadLinksConfig).init()}}]),n}();t.run();
}());

//# sourceURL=rocket-preload-links-js-after
</script>
    <script type="text/javascript" id="hoverIntent-js"
        src="{{ asset('vendor/mirage-assets/wp-includes/js/hoverIntent.min.js') }}"  defer>
    </script>
    <script type="text/javascript" id="superfish-js"
        src="{{ asset('vendor/mirage-assets/wp-content/themes/genesis/lib/js/menu/superfish.min.js') }}"
         defer></script>
    <script type="text/javascript" id="superfish-args-js"
        src="{{ asset('vendor/mirage-assets/wp-content/themes/genesis/lib/js/menu/superfish.args.min.js') }}"
         defer></script>
    <script type="text/javascript" id="skip-links-js"
        src="{{ asset('vendor/mirage-assets/wp-content/themes/genesis/lib/js/skip-links.min.js') }}"
         defer></script>
    <script type="text/javascript" id="digital-global-scripts-js"
        src="{{ asset('vendor/mirage-assets/wp-content/themes/digital-pro/js/global.js') }}" 
        defer></script>
    <script id="digital-responsive-menu-js-extra">
        var genesis_responsive_menu = {
            "mainMenu": "Men\u00fa",
            "menuIconClass": "ionicons-before ion-ios-drag",
            "subMenu": "Submen\u00fa",
            "subMenuIconClass": "ionicons-before ion-ios-arrow-down",
            "menuClasses": {
                "others": [".nav-primary"]
            }
        };
        //# sourceURL=digital-responsive-menu-js-extra
    </script>
    <script type="text/javascript" id="digital-responsive-menu-js"
        src="{{ asset('vendor/mirage-assets/wp-content/themes/digital-pro/js/responsive-menus.min.js') }}"
        defer></script>
    <script type="text/javascript" id="sourcebuster-js-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/sourcebuster/sourcebuster.min.js') }}"
         defer></script>
    <script id="wc-order-attribution-js-extra">
        var wc_order_attribution = {
            "params": {
                "lifetime": 1.0000000000000000818030539140313095458623138256371021270751953125e-5,
                "session": 30,
                "base64": false,
                "ajaxurl": "https://mirage.mx/wp-admin/admin-ajax.php",
                "prefix": "wc_order_attribution_",
                "allowTracking": true
            },
            "fields": {
                "source_type": "current.typ",
                "referrer": "current_add.rf",
                "utm_campaign": "current.cmp",
                "utm_source": "current.src",
                "utm_medium": "current.mdm",
                "utm_content": "current.cnt",
                "utm_id": "current.id",
                "utm_term": "current.trm",
                "utm_source_platform": "current.plt",
                "utm_creative_format": "current.fmt",
                "utm_marketing_tactic": "current.tct",
                "session_entry": "current_add.ep",
                "session_start_time": "current_add.fd",
                "session_pages": "session.pgs",
                "session_count": "udata.vst",
                "user_agent": "udata.uag"
            }
        };
        //# sourceURL=wc-order-attribution-js-extra
    </script>
    <script type="text/javascript" id="wc-order-attribution-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution.min.js') }}"
         defer></script>
    <script type="text/javascript" id="digital-front-script-js"
        src="{{ asset('vendor/mirage-assets/wp-content/themes/digital-pro/js/front-page.js') }}" 
        defer></script>
    <script type="text/javascript" id="elementor-webpack-runtime-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js') }}"
         defer></script>
    <script type="text/javascript" id="elementor-frontend-modules-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/js/frontend-modules.min.js') }}"
         defer></script>
    <script id="jquery-ui-core-js" src="{{ asset('vendor/mirage-assets/wp-includes/js/jquery/ui/core.min.js') }}"
         defer></script>
    <script type="text/javascript" id="elementor-frontend-js-before">
        var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false,"isScriptDebug":false},"i18n":{"shareOnFacebook":"Compartir en Facebook","shareOnTwitter":"Compartir en Twitter","pinIt":"Fijarlo","download":"Descargar","downloadImage":"Descargar imagen","fullscreen":"Pantalla completa","zoom":"Zoom","share":"Compartir","playVideo":"Reproducir video","previous":"Previo","next":"Siguiente","close":"Cerrar","a11yCarouselPrevSlideMessage":"Diapositiva anterior","a11yCarouselNextSlideMessage":"Diapositiva siguiente","a11yCarouselFirstSlideMessage":"Esta es la primera diapositiva","a11yCarouselLastSlideMessage":"Esta es la \u00faltima diapositiva","a11yCarouselPaginationBulletMessage":"Ir a la diapositiva"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"responsive":{"breakpoints":{"mobile":{"label":"M\u00f3vil en Retrato","value":767,"default_value":767,"direction":"max","is_enabled":true},"mobile_extra":{"label":"M\u00f3vil horizontal","value":880,"default_value":880,"direction":"max","is_enabled":false},"tablet":{"label":"Tableta vertical","value":1024,"default_value":1024,"direction":"max","is_enabled":true},"tablet_extra":{"label":"Tableta horizontal","value":1200,"default_value":1200,"direction":"max","is_enabled":false},"laptop":{"label":"Laptop","value":1366,"default_value":1366,"direction":"max","is_enabled":false},"widescreen":{"label":"Pantalla grande","value":2400,"default_value":2400,"direction":"min","is_enabled":false}},"hasCustomBreakpoints":false},"version":"4.1.3","is_static":false,"experimentalFeatures":{"additional_custom_breakpoints":true,"container":true,"theme_builder_v2":true,"nested-elements":true,"global_classes_should_enforce_capabilities":true,"e_variables":true,"e_opt_in_v4_page":true,"e_components":true,"e_interactions":true,"e_widget_creation":true,"import-export-customization":true,"e_pro_atomic_form":true,"e_pro_variables":true,"e_pro_interactions":true},"urls":{"assets":"https:\/\/mirage.mx\/wp-content\/plugins\/elementor\/assets\/","ajaxurl":"https:\/\/mirage.mx\/wp-admin\/admin-ajax.php","uploadUrl":"https:\/\/mirage.mx\/wp-content\/uploads"},"nonces":{"floatingButtonsClickTracking":"92eca0c79b","atomicFormsSendForm":"b8b95d9195"},"swiperClass":"swiper","settings":{"page":[],"editorPreferences":[]},"kit":{"active_breakpoints":["viewport_mobile","viewport_tablet"],"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description","woocommerce_notices_elements":[]},"post":{"id":821,"title":"Mirage%20M%C3%A9xico%20%E2%80%93%20Marca%20especializada%20en%20aires%20acondicionados%20y%20l%C3%ADnea%20blanca.","excerpt":"","featuredImage":"https:\/\/mirage.mx\/wp-content\/uploads\/2023\/05\/mirage_icon.png"}};
//# sourceURL=elementor-frontend-js-before
</script>
    <script type="text/javascript" id="elementor-frontend-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor/assets/js/frontend.min.js') }}"
         defer></script>
    <script id="e-sticky-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min.js') }}"
         defer></script>
    <script type="text/javascript" id="lity-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/unlimited-elements-for-elementor-premium/assets_libraries/lity/lity.min.js') }}"
         defer></script>
    <script type="text/javascript" id="flickity-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/shortcodes-ultimate/vendor/flickity/flickity.js') }}"
         defer></script>
    <script id="su-shortcodes-js-extra">
        var SUShortcodesL10n = {
            "noPreview": "Este shortocde no funciona con la vista previa. Por favor ins\u00e9rtalo en el editor de texto y visual\u00edzalo despu\u00e9s.",
            "magnificPopup": {
                "close": "Cerrar (Esc)",
                "loading": "Cargando...",
                "prev": "Anterior (flecha izquierda)",
                "next": "Siguiente (flecha derecha)",
                "counter": "%curr% de %total%",
                "error": "Failed to load content. \u003Ca href=\"%url%\" target=\"_blank\"\u003E\u003Cu\u003EOpen link\u003C/u\u003E\u003C/a\u003E"
            }
        };
        //# sourceURL=su-shortcodes-js-extra
    </script>
    <script type="text/javascript" id="su-shortcodes-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/shortcodes-ultimate/includes/js/shortcodes/index.js') }}"
         defer></script>
    <script type="text/javascript" id="elementor-pro-webpack-runtime-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/js/webpack-pro.runtime.min.js') }}"
         defer></script>
    <script type="text/javascript" id="wp-hooks-js"
        src="{{ asset('vendor/mirage-assets/wp-includes/js/dist/hooks.min.js') }}"></script>
    <script type="text/javascript" id="wp-i18n-js"
        src="{{ asset('vendor/mirage-assets/wp-includes/js/dist/i18n.min.js') }}"></script>
    <script type="text/javascript" id="wp-i18n-js-after">
        wp.i18n.setLocaleData( { 'text direction\u0004ltr': [ 'ltr' ] } );
//# sourceURL=wp-i18n-js-after
</script>
    <script type="text/javascript" id="elementor-pro-frontend-js-before">
        var ElementorProFrontendConfig = {"ajaxurl":"https:\/\/mirage.mx\/wp-admin\/admin-ajax.php","nonce":"c8dc4b157e","urls":{"assets":"https:\/\/mirage.mx\/wp-content\/plugins\/elementor-pro\/assets\/","rest":"https:\/\/mirage.mx\/wp-json\/"},"settings":{"lazy_load_background_images":true},"popup":{"hasPopUps":true},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"},"x-twitter":{"title":"X"},"threads":{"title":"Threads"}},"woocommerce":{"menu_cart":{"cart_page_url":"https:\/\/mirage.mx\/confirmar\/","checkout_page_url":"https:\/\/mirage.mx\/reservar\/","fragments_nonce":"857c55e0e8"}},"facebook_sdk":{"lang":"es_MX","app_id":""},"lottie":{"defaultAnimationUrl":"https:\/\/mirage.mx\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
//# sourceURL=elementor-pro-frontend-js-before
</script>
    <script type="text/javascript" id="elementor-pro-frontend-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/js/frontend.min.js') }}"
         defer></script>
    <script type="text/javascript" id="pro-elements-handlers-js"
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/elementor-pro/assets/js/elements-handlers.min.js') }}"
         defer></script>

    <!--   Unlimited Elements 2.0.10 Scripts -->
    <script type="text/javascript" data-rocket-type='text/javascript' id='unlimited-elements-scripts'>

        /* Video Play Button scripts: */

jQuery(document).ready(function(){

var objVideoButton = jQuery("#uc_blox_play_button_elementor_9e20854");

//fix for ios devices
jQuery(document).on('click.lity', function(){

   var objIframeContainer = jQuery(".lity-iframe-container");
   var objIframe = objIframeContainer.find("iframe");

   setTimeout(function(){

      var isVideoSelfHosted = objVideoButton.data("path");

      if(isVideoSelfHosted != "self_hosted")
      return(false);

      var objVideo = objIframe.contents().find("video");

      if(!objVideo.length)
      return(false);

      if(objVideo.hasClass("mac") || objVideo.hasClass("video") || objVideo.hasClass("audio")){

        objVideo.removeClass("mac");
        objVideo.removeClass("video");
        objVideo.removeClass("audio");

      }

   },400);

});

});
</script>
    <style>
        .unlimited-elements-background-overlay {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .unlimited-elements-background-overlay.uc-bg-front {
            z-index: 999;
        }
    </style>

    <script type="text/javascript" data-rocket-type='text/javascript'>

        jQuery(document).ready(function(){

				function ucBackgroundOverlayPutStart(){

					var objBG = jQuery(".unlimited-elements-background-overlay").not(".uc-bg-attached");

					if(objBG.length == 0)
						return(false);

					objBG.each(function(index, bgElement){

						var objBgElement = jQuery(bgElement);

						var targetID = objBgElement.data("forid");

						var location = objBgElement.data("location");

						switch(location){
							case "body":
							case "body_front":
								var objTarget = jQuery("body");
							break;
							case "layout":
							case "layout_front":
								var objLayout = jQuery("*[data-id=\""+targetID+"\"]");
								var objTarget = objLayout.parents(".elementor");
								if(objTarget.length > 1)
									objTarget = jQuery(objTarget[0]);
							break;
							default:
								var objTarget = jQuery("*[data-id=\""+targetID+"\"]");
							break;
						}


						if(objTarget.length == 0)
							return(true);

						var objVideoContainer = objTarget.children(".elementor-background-video-container");

						if(objVideoContainer.length == 1)
							objBgElement.detach().insertAfter(objVideoContainer).show();
						else
							objBgElement.detach().prependTo(objTarget).show();


						var objTemplate = objBgElement.children("template");

						if(objTemplate.length){

					        var clonedContent = objTemplate[0].content.cloneNode(true);

					    	var objScripts = jQuery(clonedContent).find("script");
					    	if(objScripts.length)
					    		objScripts.attr("type","text/javascript");

					        objBgElement.append(clonedContent);

							objTemplate.remove();
						}

						objBgElement.trigger("bg_attached");
						objBgElement.addClass("uc-bg-attached");

					});
				}

				ucBackgroundOverlayPutStart();

				jQuery( document ).on( 'elementor/popup/show', ucBackgroundOverlayPutStart);
				jQuery( "body" ).on( 'uc_dom_updated', ucBackgroundOverlayPutStart);

			});


		</script>
    <script>
        window.lazyLoadOptions = [{
            elements_selector: "img[data-lazy-src],.rocket-lazyload",
            data_src: "lazy-src",
            data_srcset: "lazy-srcset",
            data_sizes: "lazy-sizes",
            class_loading: "lazyloading",
            class_loaded: "lazyloaded",
            threshold: 300,
            callback_loaded: function(element) {
                if (element.tagName === "IFRAME" && element.dataset.rocketLazyload == "fitvidscompatible") {
                    if (element.classList.contains("lazyloaded")) {
                        if (typeof window.jQuery != "undefined") {
                            if (jQuery.fn.fitVids) {
                                jQuery(element).parent().fitVids()
                            }
                        }
                    }
                }
            }
        }, {
            elements_selector: ".rocket-lazyload",
            data_src: "lazy-src",
            data_srcset: "lazy-srcset",
            data_sizes: "lazy-sizes",
            class_loading: "lazyloading",
            class_loaded: "lazyloaded",
            threshold: 300,
        }];
        window.addEventListener('LazyLoad::Initialized', function(e) {
            var lazyLoadInstance = e.detail.instance;
            if (window.MutationObserver) {
                var observer = new MutationObserver(function(mutations) {
                    var image_count = 0;
                    var iframe_count = 0;
                    var rocketlazy_count = 0;
                    mutations.forEach(function(mutation) {
                        for (var i = 0; i < mutation.addedNodes.length; i++) {
                            if (typeof mutation.addedNodes[i].getElementsByTagName !==
                                'function') {
                                continue
                            }
                            if (typeof mutation.addedNodes[i].getElementsByClassName !==
                                'function') {
                                continue
                            }
                            images = mutation.addedNodes[i].getElementsByTagName('img');
                            is_image = mutation.addedNodes[i].tagName == "IMG";
                            iframes = mutation.addedNodes[i].getElementsByTagName('iframe');
                            is_iframe = mutation.addedNodes[i].tagName == "IFRAME";
                            rocket_lazy = mutation.addedNodes[i].getElementsByClassName(
                                'rocket-lazyload');
                            image_count += images.length;
                            iframe_count += iframes.length;
                            rocketlazy_count += rocket_lazy.length;
                            if (is_image) {
                                image_count += 1
                            }
                            if (is_iframe) {
                                iframe_count += 1
                            }
                        }
                    });
                    if (image_count > 0 || iframe_count > 0 || rocketlazy_count > 0) {
                        lazyLoadInstance.update()
                    }
                });
                var b = document.getElementsByTagName("body")[0];
                var config = {
                    childList: !0,
                    subtree: !0
                };
                observer.observe(b, config)
            }
        }, !1)
    </script>
    <script data-no-minify="1" async
        src="{{ asset('vendor/mirage-assets/wp-content/plugins/wp-rocket/assets/js/lazyload/17.8.3/lazyload.min.js') }}"></script>
    <script>
        (() => {
            class RocketElementorPreload {
                constructor() {
                    this.deviceMode = document.createElement("span"), this.deviceMode.id =
                        "elementor-device-mode-wpr", this.deviceMode.setAttribute("class",
                            "elementor-screen-only"), document.body.appendChild(this.deviceMode)
                }
                t() {
                    let t = getComputedStyle(this.deviceMode, ":after").content.replace(/"/g, "");
                    this.animationSettingKeys = this.i(t), document.querySelectorAll(
                        ".elementor-invisible[data-settings]").forEach(t => {
                        const e = t.getBoundingClientRect();
                        if (e.bottom >= 0 && e.top <= window.innerHeight) try {
                            this.o(t)
                        } catch (t) {}
                    })
                }
                o(t) {
                    const e = JSON.parse(t.dataset.settings),
                        i = e.m || e.animation_delay || 0,
                        n = e[this.animationSettingKeys.find(t => e[t])];
                    if ("none" === n) return void t.classList.remove("elementor-invisible");
                    t.classList.remove(n), this.currentAnimation && t.classList.remove(this.currentAnimation),
                        this.currentAnimation = n;
                    let o = setTimeout(() => {
                        t.classList.remove("elementor-invisible"), t.classList.add("animated", n), this
                            .l(t, e)
                    }, i);
                    window.addEventListener("rocket-startLoading", function() {
                        clearTimeout(o)
                    })
                }
                i(t = "mobile") {
                    const e = [""];
                    switch (t) {
                        case "mobile":
                            e.unshift("_mobile");
                        case "tablet":
                            e.unshift("_tablet");
                        case "desktop":
                            e.unshift("_desktop")
                    }
                    const i = [];
                    return ["animation", "_animation"].forEach(t => {
                        e.forEach(e => {
                            i.push(t + e)
                        })
                    }), i
                }
                l(t, e) {
                    this.i().forEach(t => delete e[t]), t.dataset.settings = JSON.stringify(e)
                }
                static run() {
                    const t = new RocketElementorPreload;
                    requestAnimationFrame(t.t.bind(t))
                }
            }
            document.addEventListener("DOMContentLoaded", RocketElementorPreload.run)
        })();
    </script>
</body>

</html>
