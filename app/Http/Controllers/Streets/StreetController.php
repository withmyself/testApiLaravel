<?php

namespace App\Http\Controllers\Streets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Street;

use Illuminate\Support\Facades\Validator;

class StreetController extends Controller
{
    public function street() {
        return response()->json(Street::get(), 200);
    }

    public function streetById($id) {
        $street = Street::find($id);

        if (is_null($street)) return response()->json(['error'=>true, 'message'=>'Not Found'], 404);

        return response()->json($street, 200);
    }

    public function streetCreate(Request $req) {
        $rules = [
            'address' => 'required|min:3',
            'photo' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) return response()->json($validator->errors(), 400);

        $photoName = sha1(time());
        if ($req->save == '1') {
            copy($req->photo, '../../testapi/storage/app/public/'.$photoName.'.jpg');
            $req->merge(['photo' => '../../testapi/storage/app/public/'.$photoName.'.jpg']);
        }

        $street = Street::create($req->all());

        return response()->json($street, 201);
    }

    public function streetEdit(Request $req, $id) {
        $rules = [
            'address' => 'required|min:3',
            'photo' => 'required|min:3'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) return response()->json($validator->errors(), 400);

        $street = Street::find($id);
        if (is_null($street)) return response()->json(['error'=>true, 'message'=>'Not Found'], 404);

        $photoName = sha1(time());
        if ($req->save == '1') {
            copy($req->photo, '../../testapi/storage/app/public/'.$photoName.'.jpg');
            $req->merge(['photo' => '../../testapi/storage/app/public/'.$photoName.'.jpg']);
        }

        $street->update($req->all());
        return response()->json($street, 200);
    }

    public function streetDelete(Request $req, $id) {
        $street = Street::find($id);

        if (is_null($street)) return response()->json(['error'=>true, 'message'=>'Not Found'], 404);

        $street->delete();
        return response()->json('', 204);
    }
}
