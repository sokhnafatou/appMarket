<?php

namespace App\Http\Controllers\Api;
// use App\Http\Controllers\Api\categoryController;
use App\Http\Controllers\Controller;
use App\Models\Produits;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Resources\ProduitResource;

class produitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produits::all();
        return ProduitResource::collection($produits, compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return ProduitResource::collection($produits, compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail($request->category_id);
       
       $product = new Produits;
       $product -> titre = $request->titre;
       $product -> slug = Str::slug($request->slug);
       $product -> price = $request->price;
       $product -> description = $request->description;

       $category->produits()->save($product);
        // $category -> produits()->create([
        //     'titre' =>$request->titre,
        //     'slug' => Str::slug($request->slug),
        //     'price' =>$request->price,
        //     'description' => $request->description,
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function show(Produits $produits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function edit(Produits $produits)
    {
        $categories = Category::all();
        $produits = Produits::findOrFail($produits);
        return ProduitResource::collection($produits, compact('categories', 'produits'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $produits_id)
    {
        // $produit = Category::findOrFail($request->category_id);
        // ->produits()->where('id',$produits_id)->first();

        // $produit->titre = $request->titre;
        // $produit->slug = Str::slug($request->slug);
        // $produit->price = $request->price;
        // $produit->description = $request->description;

        // $produit->update();

        $category = Category::findOrFail($request->category_id);

         $category -> produits()->where('id',$produits_id)->update([
            'titre' =>$request->titre,
            'slug' => Str::slug($request->slug),
            'price' =>$request->price,
            'description' => $request->description,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produits  $produits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produits $produits)
    {
        $produits -> delete();
        return response(null, 204);
    }
}
