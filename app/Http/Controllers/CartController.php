<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart; // Importante: Utiliza la fachada de Cart aquí

class CartController extends Controller
{
    public function add(Request $request){
        $producto = Product::find($request->id);
        if(empty($producto))
            return redirect('/');
        
        // Verifica si el producto existe antes de agregarlo al carrito
        if(!$producto) {
            return redirect()->back()->with('error', 'El producto no existe.');
        }

        // Agrega el producto al carrito
        Cart::add([
            'id' => $producto->id,
            'name' => $producto->name,
            'qty' => 1,
            'price' => $producto->price,
            'options' => [
                'image' => $producto->image
            ]
        ]);

        // Redirecciona de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Producto agregado al carrito: ' . $producto->name);
    }
    public function checkout()
{
    return view('front.cart.checkout');
}


public function removeItem($rowId)
{
    Cart::remove($rowId);
    return redirect()->back()->with('success', 'Producto eliminado del carrito.');
}

public function update(Request $request, $rowId)
{
    // Obtén el item del carrito
    $item = Cart::get($rowId);

    // Verifica si el item existe
    if (!$item) {
        return redirect()->back()->with('error', 'El producto no existe en el carrito.');
    }

    // Actualiza la cantidad del producto en el carrito
    Cart::update($rowId, $request->qty);

    // Redirecciona de vuelta con un mensaje de éxito
    return redirect()->back()->with('success', 'Cantidad del producto actualizada en el carrito.');
}

public function clearCart(Request $request)
{
    Cart::destroy();
    return redirect()->back()->with('success', 'El carrito ha sido vaciado.');
}


}
