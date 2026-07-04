<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Extrae tokens de búsqueda (similar al indexador)
     */
    protected function getSearchTokens($query)
    {
        $query = strip_tags($query);
        $query = Str::lower(Str::ascii($query));
        $query = preg_replace('/[^a-z0-9]/', ' ', $query);
        
        $tokens = array_filter(explode(' ', $query), function($token) {
            return strlen(trim($token)) >= 3;
        });

        return array_values($tokens);
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return response()->json([]);
        }

        $tokens = $this->getSearchTokens($query);
        if (empty($tokens)) {
            return response()->json([]);
        }

        // Búsqueda usando el motor de indexación
        $productIds = DB::table('search_index')
            ->join('search_words', 'search_index.search_word_id', '=', 'search_words.id')
            ->whereIn('search_words.word', $tokens)
            ->select('search_index.product_id', DB::raw('SUM(search_index.weight) as total_weight'))
            ->groupBy('search_index.product_id')
            ->orderByDesc('total_weight')
            ->limit(5)
            ->pluck('product_id');

        // Obtener productos y preservar el orden de relevancia
        $products = [];
        if ($productIds->isNotEmpty()) {
            $products = Product::whereIn('id', $productIds)
                ->where('is_active', true)
                ->get()
                ->sortBy(function($model) use ($productIds) {
                    return array_search($model->id, $productIds->toArray());
                });
        }

        $formatted = collect($products)->map(function($product) {
            return [
                'name' => $product->name,
                'price' => '$' . number_format($product->price, 2),
                'image' => $product->images->first() ? asset('storage/' . $product->images->first()->image_url) : null,
                'url' => route('tienda.product', $product->id)
            ];
        });

        return response()->json($formatted);
    }

    public function index(Request $request)
    {
        $query = $request->get('q');
        
        $tokens = $this->getSearchTokens($query);
        
        if (empty($tokens)) {
            $products = Product::where('id', null)->paginate(12); // Vacío
        } else {
            // Obtener IDs de productos ordenados por relevancia (peso total)
            $rankedProductIds = DB::table('search_index')
                ->join('search_words', 'search_index.search_word_id', '=', 'search_words.id')
                ->whereIn('search_words.word', $tokens)
                ->select('search_index.product_id', DB::raw('SUM(search_index.weight) as total_weight'))
                ->groupBy('search_index.product_id')
                ->orderByDesc('total_weight')
                ->pluck('product_id');

            if ($rankedProductIds->isEmpty()) {
                $products = Product::where('id', null)->paginate(12);
            } else {
                // Para mantener el orden de la query de IDs en paginación usando FIND_IN_SET (MySQL/MariaDB)
                // O usar FIELD()
                $idsString = implode(',', $rankedProductIds->toArray());
                
                $products = Product::whereIn('id', $rankedProductIds)
                    ->where('is_active', true)
                    ->orderByRaw("FIELD(id, {$idsString})")
                    ->paginate(12);
            }
        }

        return view('tienda.search', compact('products', 'query'));
    }
}
