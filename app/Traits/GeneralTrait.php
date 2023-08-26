<?php
namespace App\Traits;
trait GeneralTrait{
    public function returnError($msg)
    {
        return response()->json([
            'message'=>$msg
        ]);
    }
    public function returnSuccess($msg="")
    {
        return response()->json([
            'message'=>$msg
        ]);
    }
    public function returnData($key,$value)
    {
        return response()->json([
            $key=>$value
        ]);
    }
}
?>
