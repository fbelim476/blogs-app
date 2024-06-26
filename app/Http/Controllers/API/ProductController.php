<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // product fetch or display
        $products=Product::all();
        return $this->sendResponse(ProductResource::collection($products),'Products retrieved successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        // check validations
        $validator=Validator::make($input,[
            'name'=>'required',
            'detail'=>'required'
        ]);

        if($validator->fails())
        {
           return $this->sendError('Validation Error',$validator->errors());
        }
        else
        {
            // elequent ORM query builder
            $product=Product::create($input);
            return $this->sendResponse(new ProductResource($product),('Product addedd successfully'));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $products=Product::all();
        return $this->sendResponse(ProductResource::collection($products),'Products retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Product::where('id',$id)->first();
        return $this->sendResponse(['id'=>$id],'Product Retrieved for edit successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
             $input=$request->all();
            // elequent ORM query builder
            Product::where('id',$id)->update($input);
            return $this->sendResponse(['id'=>$id],'Product Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$products->delete();
        Product::where('id',$id)->delete();
        return $this->sendResponse(['id'=>$id],'Product deleted successfully');

    }
}
