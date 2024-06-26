<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\Register as RegisterResource;
class RegisterController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'email'=>'required',
            'password'=>'required',
            'phone'=>'required',
            'address'=>'required'

        ]);

        if($validator->fails())
        {
           return $this->sendError('Validation Error',$validator->errors());
        }
        else
        {
            // elequent ORM query builder
            // $input=$request->all();
            $input['password']=bcrypt($input['password']);
            $register=User::create($input);
            return $this->sendResponse(new RegisterResource($register),('Users added successfully'));

        }

    }


    // create a member for login api

    public function login(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {

            $user=Auth::user();
            $success['token']=$user->createToken('api')->accessToken;
            $success['name']=$user->name;
            return $this->sendResponse($success,'Users successfully Logged In');
        }
        else

        {
            return $this->sendError('Unauthorised',['error'=>'Unauthorised']);
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
        $user=User::all();
        return $this->sendResponse(RegisterResource::collection($user),'Register retrieved successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        User::where('id',$id)->first();
        return $this->sendResponse(['id'=>$id],'Registers data Retrieved for edit successfully');

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
            User::where('id',$id)->update($input);
            return $this->sendResponse(['id'=>$id],'Register data Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return $this->sendResponse(['id'=>$id],'Register data deleted successfully');

    }
}
