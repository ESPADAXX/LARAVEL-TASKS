<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use Illuminate\Support\Facades\Validator;
class MemberController extends Controller
{
    // app/Http/Controllers/MemberController.php



public function index()
{
    $members = Members::all();
    return response()->json(['members' => $members], 200);
}

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:members',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $member = Members::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return response()->json(['member' => $member], 201);
}

public function show($id)
{
    $member = Members::find($id);

    if (!$member) {
        return response()->json(['error' => 'Member not found'], 404);
    }

    return response()->json(['member' => $member], 200);
}

public function update(Request $request, $id)
{
    $member = Members::find($id);

    if (!$member) {
        return response()->json(['error' => 'Member not found'], 404);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:members,email,' . $id,
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $member->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    return response()->json(['member' => $member], 200);
}

public function destroy($id)
{
    $member = Members::find($id);

    if (!$member) {
        return response()->json(['error' => 'Member not found'], 404);
    }

    $member->delete();

    return response()->json(['message' => 'Member deleted'], 200);
}

}
