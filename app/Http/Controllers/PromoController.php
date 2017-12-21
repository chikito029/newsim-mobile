<?php

namespace App\Http\Controllers;

use App\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Promo $promo)
    {
        //
    }

    public function edit(Promo $promo)
    {
        //
    }

    public function update(Request $request, Promo $promo)
    {
        //
    }

    public function destroy(Promo $promo)
    {
        //
    }
}
