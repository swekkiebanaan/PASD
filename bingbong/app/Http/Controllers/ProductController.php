<?php

namespace App\Http\Controllers;
use App\Models\Product;
use GuzzleHttp;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts()
    {
        $client = new GuzzleHttp\Client();
        $response  = $client->request('GET', 'https://rethink-supplier.herokuapp.com/product', [
            'headers'        => ['Authorization' => 'Token ec6941df48d5aaa8c13503157fd5bf6ef127a65d'],
        ]);
        echo $response->getStatusCode(); // 200
        $bingbong = $response->getBody()->getContents();
        $bong = json_decode($bingbong);
        foreach ($bong as $bing){
            Product::create([

                'product_id'=> $bing->id,
                'name'=> $bing->name,
                'EAN_13'=> $bing->EAN_13,
                'vat_rate'=> $bing->vat_rate,
                'price_in_cents'=> $bing->price_in_cents,
                'quantity'=> 0,
                'image'=> '',
            ]);

        }
    }
    public function productCreate(Request $request){
        $product = Product::create([

            'product_id'=>$request->get('product_id'),
            'name'=> $request->get('name'),
            'EAN_13'=> $request->get('EAN_13'),
            'vat_rate'=> $request->get('vat_rate'),
            'price_in_cents'=> $request->get('price_in_cents'),
            'quantity'=> $request->get('quantity'),
            'image'=>$request->get('image'),
        ]);

        return $product;
    }
    public function productUpdate(Request $request, Product $product){
        $var = $product->update([


            'product_id'=>$request->get('id'),
            'name'=> $request->get('name'),
            'EAN_13'=> $request->get('EAN_13'),
            'vat_rate'=> $request->get('vat_rate'),
            'price_in_cents'=> $request->get('price_in_cents'),
            'quantity'=> $request->get('quantity'),

        ]);
        return $var;
    }
    public function productRemove(Product $product){
        $product->delete();

        return $product;
    }
    public function gibProducts(){
        return Product::all();
    }
}
