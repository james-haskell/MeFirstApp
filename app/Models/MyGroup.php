<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MyGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupName',
        'owner_id',
        'member_ids',
        'member_names'
    ];

    protected $casts = [
        'member_ids' => 'array',
        'member_names' => 'array'
    ];

    public static function add(Request $request, User $user) {
        $groupName = $request->groupName;

        $groupData = [
            'groupName' => $groupName,
            'owner_id' => $user->id,
            'member_ids' => [$user->id],
            'member_names' => [$user->name]
        ];
        Self::create($groupData);
        
        return response()->json([
            'success' => true
        ]);
    }

    public static function getGroupDataById($groupId) {
        $groupData = MyGroup::where('id', $groupId)
            ->get();

        return $groupData;
    }

    public static function getGroupMemberIds($groupId) {
        $memberIds = MyGroup::where('id', $groupId)
            ->get('member_ids');
        
        return $memberIds;
    }

    public static function getGroupMemberNames($groupId) {
        $memberNames = MyGroup::where('id', $groupId)
            ->get('member_names');
        
        return $memberNames;
    }
}
