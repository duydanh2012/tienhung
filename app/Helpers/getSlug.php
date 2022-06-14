<?php

use Illuminate\Support\Facades\DB;

function getSlug($id, $model)
{
    $data = $model::find($id);
    return $data;
}

function createSlug(string $slug, $model)
{
    $check = DB::table('slugs')->where('key', $slug)->count();
    if($check == 0){
        DB::table('slugs')->insert([
            'key'            => $slug,
            'reference_id'   => $model->id,
            'reference_type' =>get_class($model),
        ]);
    }else{
        DB::table('slugs')->insert([
            'key'            => $slug . '-' . $check,
            'reference_id'   => $model->id,
            'reference_type' =>get_class($model),
        ]);
    }

    return true;
}

function updateSlug(string $slug, $model)
{
    $check = DB::table('slugs')->where('key', $slug)
                               ->whereNot(function($query) use ($model){
                                   $query->where([
                                    'reference_id' => $model->id,
                                    'reference_type' => get_class($model),
                                   ]);
                               })
                               ->count();
                         
    if($check == 0){
        $x =  DB::table('slugs')->where('key', $slug)
                                ->where([
                                    'reference_id' => $model->id,
                                    'reference_type' => get_class($model),
                                ])
                                ->count();
                                
        if($x == 0){
            DB::table('slugs')->where([
                'reference_id' => $model->id,
                'reference_type' => get_class($model),
            ])->update([
                'key' => $slug,
            ]);
        }
    }else{
        DB::table('slugs')->where([
            'reference_id' => $model->id,
            'reference_type' => get_class($model),
        ])->update([
            'key' => $slug . '-' . $check,
        ]);
    }

    return true;
}

function deleteSlug($model){
    dd($model);
    DB::table('slugs')->where([
        'reference_id' => $model->id,
        'reference_type' => get_class($model),
    ])->delete();

    return true;
}

function getUrl($model){
    $key = DB::table('slugs')->where('reference_type', get_class($model))
                      ->where('reference_id', $model->id)
                      ->first()->key;
    
                      
    return  url($key);          
}

