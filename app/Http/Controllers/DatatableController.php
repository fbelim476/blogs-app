<?php

namespace App\Http\Controllers;

use App\Models\Datatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DatatableController extends Controller
{

    public function showAllData(Request $request)
    {   $all_data = Datatable::all();
        return view('datatable',compact('all_data'));
    }

     public function show(Request $request){
        $datatable = Auth::datatable();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'gender' => 'required',
            'dob' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }
        else{
            try{
                $adddata = new Datatable;
                $adddata->user_id = $datatable->id;
                $adddata->name = $request->name;
                $adddata->email = $request->email;
                $adddata->number =  $request->mobile;
                $adddata->gender= $request->gender;
                $adddata->dob=$request->dob;
                $adddata->save();

                return response()->json(['success' => true, 'msg'=> 'Data added Successfully']);
            }catch(\Exception $e){
                return response()->json(['success' => false, 'msg'=> $e->getMessage()]);
            }
        }
     }

      public function deleteData($id){
        try
        {
            $delete_data = Datatable::where('id',$id)->delete();

            return response()->json(['success' => true, 'msg' => 'Delete Successfully']);
        }
        catch(\Exception $e){

            return response()->json(['success' => false, 'msg' => $e->getMessage()]);

        }
     }

     public function edit(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'number' => 'required',
            'gender' => 'required',
            'dob' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['msg' => $validator->errors()->toArray()]);
        }
        else{
            try{
                 Datatable::where('id',$request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number' => $request->mobile,
                    'gender' => $request->gender,
                    'dob' => $request->dob,

                ]);
            return response()->json(['success' => true, 'msg' => 'Data updated successfully']);

            }
            catch(\Exception $e)
            {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);

            }
        }
     }

}
?>
