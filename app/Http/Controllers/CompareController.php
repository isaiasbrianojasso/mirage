<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class CompareController extends Controller
{
    /**
     * Muestra la vista de comparación de productos.
     */
    public function index()
    {
        $compareIds = session()->get('compare_list', []);
        
        $products = [];
        if (!empty($compareIds)) {
            $products = Product::with(['images', 'category'])->whereIn('id', $compareIds)->get();
        }

        return view('tienda.compare', compact('products'));
    }

    /**
     * Intercepta peticiones de iqitcompare (legacy)
     */
    public function actions(Request $request)
    {
        $process = $request->input('process');
        $productId = $request->input('idProduct');
        
        $compareIds = session()->get('compare_list', []);
        $success = false;

        if ($process === 'add' && $productId) {
            if (!in_array($productId, $compareIds)) {
                $compareIds[] = $productId;
                session()->put('compare_list', $compareIds);
            }
            $success = true;
        } elseif ($process === 'remove' && $productId) {
            if (($key = array_search($productId, $compareIds)) !== false) {
                unset($compareIds[$key]);
                session()->put('compare_list', array_values($compareIds));
            }
            $success = true;
        } elseif ($process === 'removeAll') {
            session()->put('compare_list', []);
            $compareIds = [];
            $success = true;
        }

        $products = [];
        if (!empty($compareIds)) {
            $products = Product::with('images')->whereIn('id', $compareIds)->get();
        }

        $floatCompare = View::make('tienda.partials.compare_floating', compact('products'))->render();

        return response()->json([
            'success' => $success,
            'floatCompare' => $floatCompare
        ]);
    }

    /**
     * Agrega un producto a la lista de comparación (API regular, si se usa en otros lados).
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $productId = $request->product_id;
        $compareIds = session()->get('compare_list', []);

        if (in_array($productId, $compareIds)) {
            return response()->json([
                'status' => 'info',
                'message' => 'El producto ya está en la lista de comparación.',
                'count' => count($compareIds)
            ]);
        }

        $compareIds[] = $productId;
        session()->put('compare_list', $compareIds);

        return response()->json([
            'status' => 'success',
            'message' => 'Producto agregado para comparar.',
            'count' => count($compareIds)
        ]);
    }

    /**
     * Elimina un producto de la lista de comparación (API regular).
     */
    public function remove(Request $request, $product_id)
    {
        $compareIds = session()->get('compare_list', []);
        
        if (($key = array_search($product_id, $compareIds)) !== false) {
            unset($compareIds[$key]);
            session()->put('compare_list', array_values($compareIds));
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Producto eliminado de la lista de comparación.',
            'count' => count($compareIds)
        ]);
    }
}
