<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShWorkNo extends Model
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
            $obj = ShWorkNo::find(request('id'));
        }
        elseif($request->has('pre_entry_id'))
        {
            $obj = ShWorkNo::where('pre_entry_id', request('pre_entry_id'))->first();
        }
        elseif($request->has('bill_no'))
        {
            $obj = ShWorkNo::where('bill_no', request('bill_no'))->first();
        }
        return $obj;
    }

}
