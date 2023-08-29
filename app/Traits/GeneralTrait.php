<?php
namespace App\Traits;
trait GeneralTrait{
    public function returnError($msg)
    {
        return response()->json([
            'success'=>false,
            'message'=>$msg
        ]);
    }
    public function returnSuccess($msg="")
    {
        return response()->json([
            'success'=>true,
            'message'=>$msg
        ]);
    }
    public function returnData($key,$value)
    {
        return response()->json([
            'success'=>true,
            $key=>$value
        ]);
    }
    public function returnValidation($validated)
    {
        return response()->json([
            'success' => false,
            'errors' => $validated
        ]);
    }
}
?>
