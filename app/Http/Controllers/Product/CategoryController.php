<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\{
    ProductsCategory as Category,
    Settings
};
use Illuminate\Support\Facades\{ Validator, Storage };


class CategoryController extends Controller
{
    
    public function __construct(Gate $gate) 
    {
        $gate->define('category', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:category')->except(['show']);
    }


    public function index() 
    {
        //Variabel For Title Menu
        $getTitle = Settings::findOrFail(1);

        $categories = Category::orderBy('id', 'asc')->get();
        return view('product.categories.index',compact('getTitle','categories'));
    }

    public function create() 
    {    
        //Variabel For Title Menu
        $getTitle = Settings::findOrFail(1);

        return view('product.categories.create', compact('getTitle'));
    }

    public function store(Request $request)
    {
        $rules = [
        'name' => 'required|string|max:255|unique:products_categories,name',
        'desc' => 'required|string|max:255'
        ];

        $eMessage = [
        'name.required' => 'Kategori tidak boleh kosong !',
        'desc.required' => 'Deskripsi tidak boleh kosong !', 
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }
        
        $category = new Category;
        $category->name = $request->name;
        $category->desc = $request->desc;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambah !');
    }

    public function edit(Category $category) 
    {
        //Variabel For Title Menu
        $getTitle = Settings::findOrFail(1);

        return view('product.categories.edit', compact('getTitle','category'));
    }

    public function update(Request $request, Category $category)
    {
        if ($request->name != $category->name){
            $name_rules = ['required', 'string', 'max:255', 'unique:products_categories,name'];
        }else{
            $name_rules = ['required'];
        }

        $rules = [
        'name' => $name_rules,
        'desc' => 'required|string|max:255'
        ];

        $eMessage = [
        'name.required' => 'Kategori tidak boleh kosong !', 
        'desc.required' => 'Deskripsi tidak boleh kosong !', 
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $category->update([
            'name' => $request->name,
            'desc' => $request->desc
        ]);

        return redirect()->route('category.index')->with('success','Kategori berhasil diubah !');
    }

    public function destroy(Category $category)
    {
        $products = $category->products->count();

        if ($products > 0){
            return redirect()->back()->with('info', "Tidak dapat menghapus Kategori, terdapat {$products} Produk di dalam Kategori ini !");
        }

        $category->delete();
        
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
