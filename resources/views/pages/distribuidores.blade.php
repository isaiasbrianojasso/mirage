@include('components.x-header')
<body class="wp-singular page-template-default page page-id-3305 page-child parent-pageid-3081 wp-theme-genesis wp-child-theme-digital-pro theme-genesis woocommerce-no-js custom-header header-image header-full-width full-width-content genesis-breadcrumbs-hidden genesis-footer-widgets-hidden elementor-default elementor-kit-23667" itemscope itemtype="https://schema.org/WebPage">
<div  class="site-container">
    @include('components.x-menu')
<ul class="genesis-skip-link"><li><a href="#genesis-content" class="screen-reader-shortcut"> Saltar al contenido principal</a></li></ul> <div  class="site-inner"><div  class="content-sidebar-wrap"><main class="content" id="genesis-content"><article class="post-3305 page type-page status-publish entry" aria-label="Distribuidores" itemscope itemtype="https://schema.org/CreativeWork"><header class="entry-header"><h1 class="entry-title" itemprop="headline">Distribuidores</h1>
</header><div class="entry-content" itemprop="text"><style>
	#wpsl-stores .wpsl-store-thumb {height:45px !important; width:45px !important;}
	#wpsl-stores, #wpsl-direction-details, #wpsl-gmap {height:550px !important;}
	#wpsl-gmap .wpsl-info-window {max-width:225px !important;}
	.wpsl-input label, #wpsl-radius label, #wpsl-category label {width:95px;}
	#wpsl-search-input  {width:179px;}
</style>
<div id="wpsl-wrap">
	<div class="wpsl-search wpsl-clearfix wpsl-checkboxes-enabled">
		<div id="wpsl-search-wrap">
			<form autocomplete="off">
			<div class="wpsl-input">
				<div><label for="wpsl-search-input">Lugar</label></div>
				<input id="wpsl-search-input" type="text" value="" name="wpsl-search-input" placeholder="" aria-required="true" />
			</div>
				<div class="wpsl-search-btn-wrap"><input id="wpsl-search-btn" type="submit" value="Buscar"></div>
		</form>
		</div>
	</div>
	<div id="wpsl-gmap" class="wpsl-gmap-canvas"></div>
	<div id="wpsl-result-list">
		<div id="wpsl-stores" >
			<ul></ul>
		</div>
		<div id="wpsl-direction-details">
			<ul></ul>
		</div>
	</div>
</div>

</div></article></main></div></div><footer class="site-footer" itemscope itemtype="https://schema.org/WPFooter"><div class="wrap">	<div class="pagebottominfo"><p>&copy; Copyright 2021 <a href="http://www.mirage.mx/">{{\App\Models\CompanySetting::get('company_name', 'Nuestra Empresa')}}</a> &middot; Todos los derechos reservados &middot; <a href="../avisos/aviso-de-privacidad">Aviso de privacidad</a></p></div>
	<p></p><nav class="nav-secondary" aria-label="Secundario" itemscope itemtype="https://schema.org/SiteNavigationElement"><div class="wrap"><ul id="menu-footer-menu" class="menu genesis-nav-menu menu-secondary js-superfish"><li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16"><a href="https://b2b.mirage.mx/" itemprop="url"><span itemprop="name">Centro Digital</span></a></li>
<li id="menu-item-17" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-17"><a href="https://www.certificacionmirage.com/" itemprop="url"><span itemprop="name">Certificacion Mirage</span></a></li>
<li id="menu-item-14" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-14"><a target="_blank" href="https://www.facebook.com/miragemx" itemprop="url"><span itemprop="name">Facebook</span></a></li>
</ul></div></nav></div></footer></div><script type="speculationrules">
{"prefetch":[{"source":"document","where":{"and":[{"href_matches":"/*"},{"not":{"href_matches":["/wp-*.php","/wp-admin/*","/wp-content/uploads/*","/wp-content/*","/wp-content/plugins/*","/wp-content/themes/digital-pro/*","/wp-content/themes/genesis/*","/*\\?(.+)"]}},{"not":{"selector_matches":"a[rel~=\"nofollow\"]"}},{"not":{"selector_matches":".no-prefetch, .no-prefetch a"}}]},"eagerness":"conservative"}]}
</script>
<script id="wpsl-info-window-template" type="text/template">
    <div data-store-id="<%= id %>" class="wpsl-info-window">
		<p>
			<% if ( wpslSettings.storeUrl == 1 && url ) { %>
			<strong><a href="{{ url('/ubicaciones') }}&lt;%=&#32;url&#32;%&gt;"><%= store %></a></strong>
			<% } else { %>
			<strong><%= store %></strong>
			<% } %>
			<span><%= address %></span>
			<% if ( address2 ) { %>
			<span><%= address2 %></span>
			<% } %>
			<span><%= city %> <%= state %> <%= zip %></span>
		</p>
		<% if ( phone ) { %>
		<span><strong>Teléfono</strong>: <%= formatPhoneNumber( phone ) %></span>
		<% } %>
		<% if ( fax ) { %>
		<span><strong>Fax</strong>: <%= fax %></span>
		<% } %>
		<% if ( email ) { %>
		<span><strong>Email</strong>: <%= formatEmail( email ) %></span>
		<% } %>
		<%= createInfoWindowActions( id ) %>
	</div>
</script>
<script id="wpsl-listing-template" type="text/template">
    <li data-store-id="<%= id %>">
		<div class="wpsl-store-location">
			<p><%= thumb %>
				<% if ( wpslSettings.storeUrl == 1 && url ) { %>
				<strong><a href="{{ url('/ubicaciones') }}&lt;%=&#32;url&#32;%&gt;"><%= store %></a></strong>
				<% } else { %>
				<strong><%= store %></strong>
				<% } %>
				<span class="wpsl-street"><%= address %></span>
				<% if ( address2 ) { %>
				<span class="wpsl-street"><%= address2 %></span>
				<% } %>
				<span><%= city %> <%= state %> <%= zip %></span>
				<span class="wpsl-country"><%= country %></span>
			</p>
			<% if ( url ) { %>
			<p><a href="{{ url('/ubicaciones') }}&lt;%=&#32;url&#32;%&gt;">Página del distribuidor</a></p>
			<% } %>
			<p class="wpsl-contact-details">
			<% if ( phone ) { %>
			<span><strong>Teléfono</strong>: <%= formatPhoneNumber( phone ) %></span>
			<% } %>
			<% if ( fax ) { %>
			<span><strong>Fax</strong>: <%= fax %></span>
			<% } %>
			<% if ( email ) { %>
			<span><strong>Email</strong>: <%= email %></span>
			<% } %>
			</p>
			
		</div>
		<div class="wpsl-direction-wrap">
			<%= distance %> km
			<%= createDirectionUrl() %>
		</div>
	</li></script>
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
</script><style type="text/css" media="screen"></style>			<script type="text/javascript">
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
	<link rel='stylesheet' id='wc-blocks-style-css' href='../wp-content/plugins/woocommerce/assets/client/blocks/wc-blocks.css%3Fver=wc-10.8.1.css' media='all' />
<script id="woocommerce-events-front-script-js-extra">
var frontObj = {"copyFromPurchaser":"autocopy"};
//# sourceURL=woocommerce-events-front-script-js-extra
</script>
<script type="text/javascript" id="woocommerce-events-front-script-js" src="{{ asset('vendor/mirage-assets/wp-content/plugins/fooevents/js/events-frontend.js') }}"  defer></script>
<script type="text/javascript" id="rocket-browser-checker-js-after">
"use strict";var _createClass=function(){function defineProperties(target,props){for(var i=0;i<props.length;i++){var descriptor=props[i];descriptor.enumerable=descriptor.enumerable||!1,descriptor.configurable=!0,"value"in descriptor&&(descriptor.writable=!0),Object.defineProperty(target,descriptor.key,descriptor)}}return function(Constructor,protoProps,staticProps){return protoProps&&defineProperties(Constructor.prototype,protoProps),staticProps&&defineProperties(Constructor,staticProps),Constructor}}();function _classCallCheck(instance,Constructor){if(!(instance instanceof Constructor))throw new TypeError("Cannot call a class as a function")}var RocketBrowserCompatibilityChecker=function(){function RocketBrowserCompatibilityChecker(options){_classCallCheck(this,RocketBrowserCompatibilityChecker),this.passiveSupported=!1,this._checkPassiveOption(this),this.options=!!this.passiveSupported&&options}return _createClass(RocketBrowserCompatibilityChecker,[{key:"_checkPassiveOption",value:function(self){try{var options={get passive(){return!(self.passiveSupported=!0)}};window.addEventListener("test",null,options),window.removeEventListener("test",null,options)}catch(err){self.passiveSupported=!1}}},{key:"initRequestIdleCallback",value:function(){!1 in window&&(window.requestIdleCallback=function(cb){var start=Date.now();return setTimeout(function(){cb({didTimeout:!1,timeRemaining:function(){return Math.max(0,50-(Date.now()-start))}})},1)}),!1 in window&&(window.cancelIdleCallback=function(id){return clearTimeout(id)})}},{key:"isDataSaverModeOn",value:function(){return"connection"in navigator&&!0===navigator.connection.saveData}},{key:"supportsLinkPrefetch",value:function(){var elem=document.createElement("link");return elem.relList&&elem.relList.supports&&elem.relList.supports("prefetch")&&window.IntersectionObserver&&"isIntersecting"in IntersectionObserverEntry.prototype}},{key:"isSlowConnection",value:function(){return"connection"in navigator&&"effectiveType"in navigator.connection&&("2g"===navigator.connection.effectiveType||"slow-2g"===navigator.connection.effectiveType)}}]),RocketBrowserCompatibilityChecker}();
//# sourceURL=rocket-browser-checker-js-after
</script>
<script id="rocket-preload-links-js-extra">
var RocketPreloadLinksConfig = {"excludeUris":"/wpstream/live/|/(?:.+/)?feed(?:/(?:.+/?)?)?$|/(?:.+/)?embed/|/reservar/??(.*)|/confirmar/?|/mi-cuenta/??(.*)|/(index.php/)?(.*)wp-json(/.*|$)|/refer/|/go/|/recommend/|/recommends/","usesTrailingSlash":"1","imageExt":"jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php","fileExt":"jpg|jpeg|gif|png|tiff|bmp|webp|avif|pdf|doc|docx|xls|xlsx|php|html|htm","siteUrl":"https://mirage.mx","onHoverDelay":"100","rateThrottle":"3"};
//# sourceURL=rocket-preload-links-js-extra
</script>
<script type="text/javascript" id="rocket-preload-links-js-after">
(function() {
"use strict";var r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},e=function(){function i(e,t){for(var n=0;n<t.length;n++){var i=t[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}return function(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}}();function i(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}var t=function(){function n(e,t){i(this,n),this.browser=e,this.config=t,this.options=this.browser.options,this.prefetched=new Set,this.eventTime=null,this.threshold=1111,this.numOnHover=0}return e(n,[{key:"init",value:function(){!this.browser.supportsLinkPrefetch()||this.browser.isDataSaverModeOn()||this.browser.isSlowConnection()||(this.regex={excludeUris:RegExp(this.config.excludeUris,"i"),images:RegExp(".("+this.config.imageExt+")$","i"),fileExt:RegExp(".("+this.config.fileExt+")$","i")},this._initListeners(this))}},{key:"_initListeners",value:function(e){-1<this.config.onHoverDelay&&document.addEventListener("mouseover",e.listener.bind(e),e.listenerOptions),document.addEventListener("mousedown",e.listener.bind(e),e.listenerOptions),document.addEventListener("touchstart",e.listener.bind(e),e.listenerOptions)}},{key:"listener",value:function(e){var t=e.target.closest("a"),n=this._prepareUrl(t);if(null!==n)switch(e.type){case"mousedown":case"touchstart":this._addPrefetchLink(n);break;case"mouseover":this._earlyPrefetch(t,n,"mouseout")}}},{key:"_earlyPrefetch",value:function(t,e,n){var i=this,r=setTimeout(function(){if(r=null,0===i.numOnHover)setTimeout(function(){return i.numOnHover=0},1e3);else if(i.numOnHover>i.config.rateThrottle)return;i.numOnHover++,i._addPrefetchLink(e)},this.config.onHoverDelay);t.addEventListener(n,function e(){t.removeEventListener(n,e,{passive:!0}),null!==r&&(clearTimeout(r),r=null)},{passive:!0})}},{key:"_addPrefetchLink",value:function(i){return this.prefetched.add(i.href),new Promise(function(e,t){var n=document.createElement("link");n.rel="prefetch",n.href=i.href,n.onload=e,n.onerror=t,document.head.appendChild(n)}).catch(function(){})}},{key:"_prepareUrl",value:function(e){if(null===e||"object"!==(void 0===e?"undefined":r(e))||!1 in e||-1===["http:","https:"].indexOf(e.protocol))return null;var t=e.href.substring(0,this.config.siteUrl.length),n=this._getPathname(e.href,t),i={original:e.href,protocol:e.protocol,origin:t,pathname:n,href:t+n};return this._isLinkOk(i)?i:null}},{key:"_getPathname",value:function(e,t){var n=t?e.substring(this.config.siteUrl.length):e;return n.startsWith("/")||(n="/"+n),this._shouldAddTrailingSlash(n)?n+"/":n}},{key:"_shouldAddTrailingSlash",value:function(e){return this.config.usesTrailingSlash&&!e.endsWith("/")&&!this.regex.fileExt.test(e)}},{key:"_isLinkOk",value:function(e){return null!==e&&"object"===(void 0===e?"undefined":r(e))&&(!this.prefetched.has(e.href)&&e.origin===this.config.siteUrl&&-1===e.href.indexOf("?")&&-1===e.href.indexOf("#")&&!this.regex.excludeUris.test(e.href)&&!this.regex.images.test(e.href))}}],[{key:"run",value:function(){"undefined"!=typeof RocketPreloadLinksConfig&&new n(new RocketBrowserCompatibilityChecker({capture:!0,passive:!0}),RocketPreloadLinksConfig).init()}}]),n}();t.run();
}());

//# sourceURL=rocket-preload-links-js-after
</script>
<script type="text/javascript" id="hoverIntent-js" src="{{ asset('vendor/mirage-assets/wp-includes/js/hoverIntent.min.js') }}"  defer></script>
<script type="text/javascript" id="superfish-js" src="{{ asset('vendor/mirage-assets/wp-content/themes/genesis/lib/js/menu/superfish.min.js') }}"  defer></script>
<script type="text/javascript" id="superfish-args-js" src="{{ asset('vendor/mirage-assets/wp-content/themes/genesis/lib/js/menu/superfish.args.min.js') }}"  defer></script>
<script type="text/javascript" id="skip-links-js" src="{{ asset('vendor/mirage-assets/wp-content/themes/genesis/lib/js/skip-links.min.js') }}"  defer></script>
<script type="text/javascript" id="digital-global-scripts-js" src="{{ asset('vendor/mirage-assets/wp-content/themes/digital-pro/js/global.js') }}"  defer></script>
<script id="digital-responsive-menu-js-extra">
var genesis_responsive_menu = {"mainMenu":"Men\u00fa","menuIconClass":"ionicons-before ion-ios-drag","subMenu":"Submen\u00fa","subMenuIconClass":"ionicons-before ion-ios-arrow-down","menuClasses":{"others":[".nav-primary"]}};
//# sourceURL=digital-responsive-menu-js-extra
</script>
<script type="text/javascript" id="digital-responsive-menu-js" src="{{ asset('vendor/mirage-assets/wp-content/themes/digital-pro/js/responsive-menus.min.js') }}"  defer></script>
<script type="text/javascript" id="sourcebuster-js-js" src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/sourcebuster/sourcebuster.min.js') }}"  defer></script>
<script id="wc-order-attribution-js-extra">
var wc_order_attribution = {"params":{"lifetime":1.0000000000000000818030539140313095458623138256371021270751953125e-5,"session":30,"base64":false,"ajaxurl":"https://mirage.mx/wp-admin/admin-ajax.php","prefix":"wc_order_attribution_","allowTracking":true},"fields":{"source_type":"current.typ","referrer":"current_add.rf","utm_campaign":"current.cmp","utm_source":"current.src","utm_medium":"current.mdm","utm_content":"current.cnt","utm_id":"current.id","utm_term":"current.trm","utm_source_platform":"current.plt","utm_creative_format":"current.fmt","utm_marketing_tactic":"current.tct","session_entry":"current_add.ep","session_start_time":"current_add.fd","session_pages":"session.pgs","session_count":"udata.vst","user_agent":"udata.uag"}};
//# sourceURL=wc-order-attribution-js-extra
</script>
<script type="text/javascript" id="wc-order-attribution-js" src="{{ asset('vendor/mirage-assets/wp-content/plugins/woocommerce/assets/js/frontend/order-attribution.min.js') }}"  defer></script>
<script id="wpsl-js-js-extra">
var wpslLabels = {"preloader":"Buscando...","noResults":"No se encontraron resultados","moreInfo":"M\u00e1s informaci\u00f3n \u003E\u003E","generalError":"Algo sali\u00f3 mal, por favor int\u00e9ntelo nuevamente.","queryLimit":"L\u00cdMITE DE USO ALCANZADO","directions":"Mostrar ruta","noDirectionsFound":"No se encontraron direcciones","startPoint":"Punto de partida","back":"Regresar","streetView":"Vista de calle","zoomHere":"Ampliar aqu\u00ed","copyright":"Powered by Google, 2026 Google"};
var wpslGeolocationErrors = {"denied":"The application does not have permission to use the Geolocation API.","unavailable":"Location information is unavailable.","timeout":"The geolocation request timed out.","generalError":"An unknown error occurred."};
var wpslSettings = {"apiVersions":{"autocomplete":"legacy"},"startMarker":"dark-green2x.png","markerClusters":"0","streetView":"0","autoComplete":"0","autoLocate":"1","autoLoad":"1","markerEffect":"info_window","markerStreetView":"0","markerZoomTo":"0","newWindow":"0","resetMap":"1","directionRedirect":"0","phoneUrl":"0","clickableDetails":"0","moreInfoLocation":"store listings","mouseFocus":"1","templateId":"below_map","maxResults":"10","searchRadius":"25","distanceUnit":"km","geoLocationTimeout":"7500","ajaxurl":"https://mirage.mx/wp-admin/admin-ajax.php","language":"es","mapControls":"\u003Cdiv id=\"wpsl-map-controls\" \u003E\u003Cdiv class=\"wpsl-icon-reset\"\u003E\u003Cspan\u003E\ue801\u003C/span\u003E\u003C/div\u003E\u003Cdiv class=\"wpsl-icon-direction\"\u003E\u003Cspan\u003E\ue800\u003C/span\u003E\u003C/div\u003E\u003C/div\u003E","geocodeComponents":{"country":"MX"},"storeMarker":"red2x.png","mapType":"roadmap","mapTypeControl":"0","zoomLevel":"3","zoomControls":"0","cameraControl":"","fullscreen":"0","startLatlng":"27.4827729,-109.930367","autoZoomLevel":"15","scrollWheel":"1","controlPosition":"left","url":"https://mirage.mx/wp-content/plugins/wp-store-locator/","markerIconProps":{"scaledSize":"24,35","origin":"0,0","anchor":"12,35"},"storeUrl":"0","maxDropdownHeight":"300","enableStyledDropdowns":"1","mapTabAnchor":"wpsl-map-tab","mapTabAnchorReturn":"","gestureHandling":"auto","directionsTravelMode":"DRIVING","runFitBounds":"1","mapStyle":"","categoryIds":"209","collectStatistics":"1"};
//# sourceURL=wpsl-js-js-extra
</script>
<script id="wpsl-js-js" src="../wp-content/plugins/wp-store-locator/js/wpsl-gmap.min.js%3Fver=2.3.2"></script>
<script id="wpsl-gmap-js" src="https://maps.google.com/maps/api/js?language=es&#038;region=mx&#038;key=AIzaSyBqTIZeFqSA4s0MyDia9OznTeN85KfpfS4&#038;v=quarterly&#038;callback=wpslCallback"  defer></script>
<script id="underscore-js" src="../wp-includes/js/underscore.min.js%3Fver=1.13.8"></script>
		<style>
			.unlimited-elements-background-overlay{
				position:absolute;
				top:0px;
				left:0px;
				width:100%;
				height:100%;
				z-index:0;
			}

			.unlimited-elements-background-overlay.uc-bg-front{
				z-index:999;
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
		<script>window.lazyLoadOptions=[{elements_selector:"img[data-lazy-src],.rocket-lazyload",data_src:"lazy-src",data_srcset:"lazy-srcset",data_sizes:"lazy-sizes",class_loading:"lazyloading",class_loaded:"lazyloaded",threshold:300,callback_loaded:function(element){if(element.tagName==="IFRAME"&&element.dataset.rocketLazyload=="fitvidscompatible"){if(element.classList.contains("lazyloaded")){if(typeof window.jQuery!="undefined"){if(jQuery.fn.fitVids){jQuery(element).parent().fitVids()}}}}}},{elements_selector:".rocket-lazyload",data_src:"lazy-src",data_srcset:"lazy-srcset",data_sizes:"lazy-sizes",class_loading:"lazyloading",class_loaded:"lazyloaded",threshold:300,}];window.addEventListener('LazyLoad::Initialized',function(e){var lazyLoadInstance=e.detail.instance;if(window.MutationObserver){var observer=new MutationObserver(function(mutations){var image_count=0;var iframe_count=0;var rocketlazy_count=0;mutations.forEach(function(mutation){for(var i=0;i<mutation.addedNodes.length;i++){if(typeof mutation.addedNodes[i].getElementsByTagName!=='function'){continue}
if(typeof mutation.addedNodes[i].getElementsByClassName!=='function'){continue}
images=mutation.addedNodes[i].getElementsByTagName('img');is_image=mutation.addedNodes[i].tagName=="IMG";iframes=mutation.addedNodes[i].getElementsByTagName('iframe');is_iframe=mutation.addedNodes[i].tagName=="IFRAME";rocket_lazy=mutation.addedNodes[i].getElementsByClassName('rocket-lazyload');image_count+=images.length;iframe_count+=iframes.length;rocketlazy_count+=rocket_lazy.length;if(is_image){image_count+=1}
if(is_iframe){iframe_count+=1}}});if(image_count>0||iframe_count>0||rocketlazy_count>0){lazyLoadInstance.update()}});var b=document.getElementsByTagName("body")[0];var config={childList:!0,subtree:!0};observer.observe(b,config)}},!1)</script><script data-no-minify="1" async src="../wp-content/plugins/wp-rocket/assets/js/lazyload/17.8.3/lazyload.min.js"></script><script>(()=>{class RocketElementorPreload{constructor(){this.deviceMode=document.createElement("span"),this.deviceMode.id="elementor-device-mode-wpr",this.deviceMode.setAttribute("class","elementor-screen-only"),document.body.appendChild(this.deviceMode)}t(){let t=getComputedStyle(this.deviceMode,":after").content.replace(/"/g,"");this.animationSettingKeys=this.i(t),document.querySelectorAll(".elementor-invisible[data-settings]").forEach(t=>{const e=t.getBoundingClientRect();if(e.bottom>=0&&e.top<=window.innerHeight)try{this.o(t)}catch(t){}})}o(t){const e=JSON.parse(t.dataset.settings),i=e.m||e.animation_delay||0,n=e[this.animationSettingKeys.find(t=>e[t])];if("none"===n)return void t.classList.remove("elementor-invisible");t.classList.remove(n),this.currentAnimation&&t.classList.remove(this.currentAnimation),this.currentAnimation=n;let o=setTimeout(()=>{t.classList.remove("elementor-invisible"),t.classList.add("animated",n),this.l(t,e)},i);window.addEventListener("rocket-startLoading",function(){clearTimeout(o)})}i(t="mobile"){const e=[""];switch(t){case"mobile":e.unshift("_mobile");case"tablet":e.unshift("_tablet");case"desktop":e.unshift("_desktop")}const i=[];return["animation","_animation"].forEach(t=>{e.forEach(e=>{i.push(t+e)})}),i}l(t,e){this.i().forEach(t=>delete e[t]),t.dataset.settings=JSON.stringify(e)}static run(){const t=new RocketElementorPreload;requestAnimationFrame(t.t.bind(t))}}document.addEventListener("DOMContentLoaded",RocketElementorPreload.run)})();</script>
</body>
</html>