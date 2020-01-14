<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Temp002 extends Model
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
            $obj = Temp002::find(request('id'));
        }
        if($request->has('tag1'))
        {
            $obj = Temp002::where('tag1', $request->tag1)
                ->first();
        }
        return $obj;
    }

    public function ryfzAll(){
        $model = new Temp002();
        $model = $model->where('tag1', '<>' ,'');
        $model->limit(100);
        $model->orderBy('tag1','desc');
        return $model->get();
    }


}
