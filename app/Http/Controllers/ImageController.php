<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    private function infoResponse($status, $message): JsonResponse {
        return response()->json([
            'message' => $message,
        ],$status);
    }

    public function deleteImage($id): JsonResponse {
        $validator = Validator::make(['id'=>$id],[
            'id' => 'required|integer|exists:images,id'
        ]);

        if($validator->fails()){
            return $this->infoResponse(422, $validator->messages());
        }

        $image = Image::find($id);
        $product_id = $image->product_id;
        $numberOfImages = $image::where('product_id',$product_id)->count();

        if($numberOfImages == 1){
            return $this->infoResponse(403, 'You can not delete the last image.');
        }

        $image->delete();
        return $this->infoResponse(200, 'Image has been successfully deleted!');
    }
}
