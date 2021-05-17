<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MyGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupName',
        'owner_id'
    ];

    public static function add(Request $request, User $user) {
        $groupName = $request->groupName;
        $groupData = [
            'groupName' => $groupName,
            'owner_id' => $user->id
        ];
        Self::create($groupData);
        
        return response()->json([
            'success' => true
        ]);
    }
}
