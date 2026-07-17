<footer class="bg-gray-900 text-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Columna 1 -->
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Soporte</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Preguntas Frecuentes</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Registro de equipos</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Centros de Servicio</a></li>
                </ul>
            </div>
            
            <!-- Columna 2 -->
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Aplicaciones Móviles</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">App de Control WiFi</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Mirage Home</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Códigos de Diagnóstico</a></li>
                </ul>
            </div>
            
            <!-- Columna 3 -->
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Corporativo</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Semblanza Empresarial</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Certificaciones</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Infraestructura</a></li>
                    <li><a href="{{ route('tienda.index') }}" class="hover:text-white transition-colors text-indigo-400 font-semibold">Tienda en línea</a></li>
                </ul>
            </div>
            
            <!-- Columna 4 (Marca) -->
            <div>
                <div class="text-2xl font-black text-white tracking-widest mb-4">MIRAGE</div>
                <p class="text-sm text-gray-400 mb-4 leading-relaxed">
                    Somos la principal marca mexicana de aires acondicionados tipo minisplit, líder nacional en ventas.
                </p>
            </div>
        </div>
    </div>

    <!-- Direcciones CEDIF -->
    <div class="border-t border-gray-800 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h4 class="text-white text-sm font-bold uppercase tracking-wider mb-6">Nuestros CEDIF</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 text-sm text-gray-500">
                @foreach(\App\Models\Location::where('is_active', true)->get() as $location)
                <div>
                    <h5 class="text-gray-300 font-semibold">{{ $location->name }}</h5>
                    <p>{{ collect([$location->address, $location->city, $location->state, $location->country])->filter()->implode(', ') }}{{ $location->zip ? ' C.P. ' . $location->zip : '' }}{{ $location->phone ? ' - Tel ' . $location->phone : '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} {{\App\Models\CompanySetting::get('company_name', 'Nuestra Empresa')}}. Todos los derechos reservados.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white">Aviso de Privacidad</a>
                <a href="#" class="hover:text-white">Centro Digital</a>
            </div>
        </div>
    </div>
</footer>
