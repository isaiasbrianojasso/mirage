<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class QuickViewController extends Controller
{
    public function show($id)
    {
        $product = Product::with('images', 'category')->find($id);
        if (!$product) {
            $product = Product::with('images', 'category')->firstOrFail();
        }

        $images = $product->images->map(function($img) {
            $url = $img->image_url;
            if (!str_starts_with($url, 'http')) {
                $url = asset('storage/' . $url);
            }
            return $url;
        });

        // En caso de que no haya imágenes, agregamos una por defecto
        if ($images->isEmpty()) {
            $images->push(asset('tienda/img/mirage-logo-1534899548.jpg'));
        }

        $discountPercentage = 0;
        if ($product->discount_price && $product->price > 0) {
            $discountPercentage = round((($product->price - $product->discount_price) / $product->price) * 100);
        }

        // Especificaciones por defecto de los equipos Mirage para rellenar
        $specifications = $product->specifications ?? [
            'Acabado de lujo',
            'Eficiencia energética superior',
            'Sueño confortable con control automático',
            'Ventilación de alta velocidad',
            'Auto direccionamiento y oscilación de flujo de aire',
            'Filtro removible y lavable de fácil mantenimiento',
            'Kit de instalación de cobre incluido',
            'Apagado / Encendido programable'
        ];

        // Obtener ID del video a partir de video_url si existe
        $youtubeVideoId = null;
        if (!empty($product->video_url)) {
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $product->video_url, $matches)) {
                $youtubeVideoId = $matches[1];
            }
        }

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description ?? 'Equipo de aire acondicionado Mirage con alto desempeño.',
            'sku' => $product->sku ?? 'N/A',
            'price' => number_format($product->price, 2),
            'discount_price' => $product->discount_price ? number_format($product->discount_price, 2) : null,
            'discount_percentage' => $discountPercentage,
            'stock' => $product->stock,
            'category_name' => $product->category ? $product->category->name : 'General',
            'images' => $images,
            'specifications' => $specifications,
            'video_id' => $youtubeVideoId,
            'add_to_cart_url' => route('cart.add'),
            'csrf_token' => csrf_token()
        ]);
    }

    public function compare(Request $request)
    {
        $request->validate([
            'ids' => 'required|array|min:1|max:2',
            'ids.*' => 'exists:products,id'
        ]);

        $products = Product::with('images', 'category')
            ->whereIn('id', $request->ids)
            ->get();
            
        if ($products->isEmpty()) {
            $products = Product::with('images', 'category')->take(2)->get();
        }

        $compareData = $products->map(function($product) {
            $primaryImage = $product->images->where('is_primary', true)->first() ?? $product->images->first();
            $imageUrl = $primaryImage
                ? (str_starts_with($primaryImage->image_url, 'http')
                    ? $primaryImage->image_url
                    : asset('storage/' . $primaryImage->image_url))
                : asset('tienda/img/mirage-logo-1534899548.jpg');

            $discountPercentage = 0;
            if ($product->discount_price && $product->price > 0) {
                $discountPercentage = round((($product->price - $product->discount_price) / $product->price) * 100);
            }

            // Atributos para comparar en la tabla
            $toneladas = '1 TON';
            if (str_contains(strtolower($product->name), '2 ton') || str_contains(strtolower($product->name), '2 toneladas')) {
                $toneladas = '2 TON';
            } elseif (str_contains(strtolower($product->name), '1.5 ton')) {
                $toneladas = '1.5 TON';
            }

            $tecnologia = 'Inverter';
            if (str_contains(strtolower($product->name), 'life 12')) {
                $tecnologia = 'Estándar / Inverter';
            }

            $voltaje = '220 V';
            if (str_contains(strtolower($product->name), '110v') || str_contains(strtolower($product->name), '110')) {
                $voltaje = '110 V';
            }

            return [
                'id' => $product->id,
                'name' => $product->name,
                'image_url' => $imageUrl,
                'price' => number_format($product->price, 2),
                'discount_price' => $product->discount_price ? number_format($product->discount_price, 2) : null,
                'discount_percentage' => $discountPercentage,
                'toneladas' => $toneladas,
                'tecnologia' => $tecnologia,
                'voltaje' => $voltaje,
                'stock' => $product->stock > 0 ? 'En stock' : 'Agotado',
                'add_to_cart_url' => route('cart.add'),
                'csrf_token' => csrf_token()
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $compareData
        ]);
    }
}
