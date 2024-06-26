<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
class BaseController extends Controller
{
/*pass a api response success
  api call 200 ok
  api not call 404 not found
  api service error 503

*/

// send response to api create a member function
public function sendResponse($result,$message)
{

    $response=[

        'success'=>true,
        'data'=>$result,
        'message'=>$message,

    ];

    // result pass in json and status will be 200
    return response()->json($response,200);

}

/*pass a api response error
  api call 404 error
  api not call 404 not found

*/


// send response to api create a member function
public function sendError($error,$errorMessage=[],$code=404)
{

    $response=[

        'success'=>false,
        'message'=>$error,

    ];

    if(!empty($errorMessage))
    {
        $response['data']=$errorMessage;
    }
    // result pass in json and status will be 404
    return response()->json($response,$code);

}


}
