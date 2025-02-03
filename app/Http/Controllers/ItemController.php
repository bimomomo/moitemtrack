<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    function index(Request $r) {
        $item = DB::table('item')->get();
        $imag = DB::table('images')->get();
        $tag = [];
        foreach ($item as $k => $v) {
            if (is_array(json_decode($v->tag))) {
                $tag = array_merge($tag, json_decode($v->tag));
            }
            $img = [];
            $mimg = '';
            foreach ($imag as $m) {
                if ($m->item_id == $v->id) {
                    $img[] = $m->url;
                    if ($m->type==1 || $mimg=='') {
                        $mimg = $m->url;
                    }
                }
            }
            $v->image_list = $img;
            $v->image_main = $mimg;
        }
        $tag = array_values(array_unique($tag));
        
        return [
            'item' => $item,
            'category' => array_values(array_unique($item->pluck('category')->toArray())),
            'tag' => $tag,
        ];
    }

    function store(Request $r) {
        // return $r->all();
        $mime = ['png','jpeg','jpg','webp','gif','svg','bmp'];
        $valid = Validator::make($r->all(), [
            'images' => 'required|mimes:'.implode(',',$mime)
        ]);
        // if ($valid->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'File Failed',
        //         'error' => $valid->errors(),
        //     ], 400);
        // }
        if ($r->id) {
            $itmid = $r->id;
            DB::table('item')->where('id', $r->id)->update([
                'category' => $r->category,
                'name' => $r->name,
                'description' => $r->description,
                'tag' => $r->tags ? json_encode(explode(',',$r->tags)) : null,
                'properties' => $r->properties ? ($r->properties) : null,
                'additional_info' => $r->additional_info ? json_encode($r->additional_info) : null,
                'updated_at' => now(),
            ]);
        } else {
            $itmid = DB::table('item')->insertGetId([
                'category' => $r->category,
                'name' => $r->name,
                'description' => $r->description,
                'tag' => $r->tags ? json_encode(explode(',',$r->tags)) : null,
                'properties' => $r->properties ? ($r->properties) : null,
                'additional_info' => $r->additional_info ? json_encode($r->additional_info) : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $img = $r->file('images');
        $id = $itmid;
        $tbins = [];
        // return $img;
        foreach ($r->all() as $k => $v) {
            if(is_file($v)){
                $fn = time().'_'.($v->getClientOriginalName());
                $fp = $v->storeAs('upload/id'.$id, $fn, 'local');
                $tbins[] = [
                    'type' => 0,
                    'item_id' => $id,
                    'url' => $fp,
                ];
            }
        }
        // return $r->all();
        DB::table('images')->insert($tbins);
    }

    function update(Request $r, $id) {
        // DB::table('item')->where('id', $id)->update([
        //     'category' => $r->category,
        //     'name' => $r->name,
        //     'description' => $r->description,
        //     'tag' => $r->tag ? $r->tag : null,
        //     'properties' => $r->properties ? $r->properties : null,
        //     'additional_info' => $r->additional_info ? $r->additional_info : null,
        //     'updated_at' => now(),
        // ]);
    }

    function destroy($id, Request $r) {
        if ($r->delimg==1) {
            DB::table('images')->where('item_id', $id)->where('url', $r->imgurl)->delete();
        } else {
            DB::table('item')->where('id', $id)->delete();
            DB::table('images')->where('item_id', $id)->delete();
        }
    }
}
