<?php

namespace GlebStarProducts\Middleware;

use Closure;
use GlebStarProducts\Models\Product;

class ProductMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userType = app('current_user_type');
        $currentAction = $request->route ()->getAction ()['as'];

        if ('admin' != $userType && 'manager' != $userType) {
            abort(403);
        }

        // add new product can only admin
        if ('products.create' == $currentAction || 'products.store' == $currentAction) {
            if ('admin' != $userType) {
                abort(403);
            }
        }

        // delete product can only admin
        if ('products.destroy' == $currentAction) {
            if ('admin' != $userType) {
                abort(403);
            }
        }

        // check exist product
        if ($request->products) {
            $product = Product::find($request->products);

            if (! $product) {
                abort(404);
            }

            // update art can only admin
            if ($request->art) {
                if ( ($request->art != $product->art) && 'admin' != $userType) {
                    abort(403);
                }
            }
        }

        return $next($request);
    }
}