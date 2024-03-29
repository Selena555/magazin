<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(product $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $cr)
    {
        //
    }
}
