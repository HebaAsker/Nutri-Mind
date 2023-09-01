<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait MealOperationsTrait
{
    use GeneralTrait;
    public function view(Request $request, $model)
    {
        return $this->getData($request, $model, false);
    }

    public function save($request, $model, $oldModel, $oldTable)
    {
        $validator = Validator::make(['id' => $request->id], [
            'id' => "required|integer|exists:$oldTable,id",
        ], [
            'id.*' => 'You are not authorized to access this information.'
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors());
        }

        $oldRowId = $request->id;
        $data = $oldModel::where('id', $oldRowId)->first();
        $model::create($data->only(['meal_id', 'patient_id']));
        $data->delete();

        return $this->returnSuccess('Meal added successfully.');
    }
}
?>
