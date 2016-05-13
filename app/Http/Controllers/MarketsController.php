<?php

namespace Rebuy\Http\Controllers;

use Rebuy\View;
use Rebuy\Product;
use Illuminate\Http\Request;

class MarketsController extends Controller {

    /**
     * Show index page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('markets');
    }

    /**
     * Show a product.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        $product->views()->save(new View);

        return view('products.show', compact('product'));
    }
}
