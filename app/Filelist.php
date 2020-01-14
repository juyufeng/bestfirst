<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Filelist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [

    // ];

    protected $guarded = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function findOne(Request $request){
        //id 或 主键
        if($request->has('id'))
        {
            $obj = Filelist::find(request('id'));
        }
        elseif($request->has('pre_entry_id'))
        {
            $obj = Filelist::where('pre_entry_id', request('pre_entry_id'))->first();
        }
        elseif($request->has('bill_no'))
        {
            $obj = Filelist::where('bill_no', request('bill_no'))->first();
        }
        elseif($request->has('bucket') && $request->has('object'))
        {
            $obj = Filelist::where('bucket', request('bucket'))
            ->where('object', request('object'))
            ->first();
        }
        return $obj;
    }

}
