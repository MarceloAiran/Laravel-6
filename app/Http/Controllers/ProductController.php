<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;

        // $this->middleware('auth');
        // $this->middleware('auth')->only([
        //     'index'
        // ]);
        // $this->middleware('auth')->except([
        //     'index'
        // ]);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate();

        return view('admin.pages.products.index', [
            'products'  =>  $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUpdateProductRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {

        $data = $request->only('name', 'description', 'price');


        if($request->hasFile('image') && $request->image->isValid() ){

            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }


        Product::create($data);

        return redirect()->route('products.index');


        /*OUTRO METODO PARA SALVAR...*/

        // $data = $request->all();
        // $product = new Product;
        // $product->name = $request->name;
        // $product->save();



        // $request->validate([
        //     'name' => 'required|min:3|max:255',
        //     'description' => 'nullable|min:3|max:1000',
        //     'photo' => 'image'
        // ]);

        // dd('ok');



        // dd($request->all());
        // dd($request->name;
        // dd($request->only(["name","description"]));
        // dd($request->has(['name']));
        // dd($request->input('teste', 'default'));
        // dd($request->except("_token"));
        // if ($request->file('photo')->isValid()) {
            // dd($request->photo->extension());
            // dd($request->photo->store('products'));

        //     $nameFile = $request->name . '.' . $request->photo->extension();

        //     dd($request->photo->storeAs('products', $nameFile));
        // }
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $product = Product::where('id', $id)->first();
        // dd(Product::find($id));
        if(!$product = Product::find($id))
            return redirect()->back();

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if(!$product)
            return redirect()->back();


        return view("admin.pages.products.edit",[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
       
        $product = Product::find($id);
       
        if(!$product)
            return redirect()->back();

        $data = $request->all();

        if($request->hasFile('image') && $request->image->isValid() ){

            if($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('products.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
       
        if(!$product)
            return redirect()->back();

        if($product->image && Storage::exists($product->image)){
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    public function search(Request $request)
    {
        $product = new Product();

        // $filters = $request->page;
        $filters = $request->except("_token");

        $products = $product->search($request->filter);

        return view('admin.pages.products.index', [
            'products'  =>  $products,
            'filters'   => $filters
        ]);

    }
  
}
