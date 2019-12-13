<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
        ]);

        Category::create([
            'nama_kategori' => $request['nama_kategori'],
            'deskripsi' => $request['deskripsi'],
        ]);
        return redirect('/categories')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $ctname= $request->nama_kategori;
        $ctdata = $category->nama_kategori;
        $checkct = $ctname == $ctdata;

        if ($checkct){
            $request->validate([
                'nama_kategori' => ['required', 'string', 'max:255'],
                'deskripsi' => ['required', 'string', 'max:255'],
            ]);
            Category::where('id', $category->id)
                ->update([
                    'nama_kategori' => $request['nama_kategori'],
                    'deskripsi' => $request['deskripsi'],
                ]);
        }else{
            $request->validate([
                'nama_kategori' => ['required', 'string', 'max:255', 'unique:categories'],
                'deskripsi' => ['required', 'string', 'max:255'],
            ]);
            Category::where('id', $category->id)
                ->update([
                    'nama_kategori' => $request['nama_kategori'],
                    'deskripsi' => $request['deskripsi'],
                ]);
        }

        return redirect('/categories')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::destroy($category->id);
        return redirect('/categories')->with('status', 'Data berhasil dihapus');

    }
}
