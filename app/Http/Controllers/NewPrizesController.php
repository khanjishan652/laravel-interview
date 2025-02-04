<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prize;
use DataTables;
use Exception;
use App\Http\Requests\PrizeRequest;

class NewPrizesController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $prizes = Prize::select('*')->latest();
                return Datatables::of($prizes)
                  ->addIndexColumn()
                  ->addColumn('awarded', function($row){
                    return 0;
                })
                  ->addColumn('action', function($row){
                    $btn  = '<a href="'.route('prizes.edit',$row->id).'" class="btn-edit btn-td  mr-2" ><i class="fa fa-edit" data-toggle="tooltip" title="" data-placement="top"></i></a>';
                    $btn .= ' | <a href="'.route('prizes.destroy',$row->id).'" class="btn-td mr-2"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action','awarded'])->make(true);
           }else{
              $probability = floatval(Prize::sum('probability'));
              return view('new_prizes.index',compact('probability'));
           }
    }

    public function create(){
        $probability = floatval(Prize::sum('probability'));
        return view('new_prizes.create',compact('probability'));
    }

    public function store(PrizeRequest $request){
        try {
            $data = $request->only('title','probability');
            Prize::create($data);
            return response()->json([
                'status' => true,
                'url'=>route('prizes.index'),
                'data' => [], 
                'message' => 'Created successfully!'
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'responsecode' => 201,
                'data' => [],
                'message' =>$e->getMessage()
            ]);
        }

    }
    public function edit($id){
        $edit = Prize::findOrFail($id);
        $probability = floatval(Prize::sum('probability'));
        return view('new_prizes.edit',compact('edit','probability'));
    }
    
    public function update(PrizeRequest $request,$id){
        try {
            $data = $request->only('title','probability');
            Prize::findOrFail($id)->update($data);
            return response()->json([
                'status' => true,
                'url'=>route('prizes.index'),
                'data' => [], 
                'message' => 'Updated successfully!'
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'responsecode' => 201,
                'data' => [],
                'message' =>$e->getMessage()
            ]);
        }

    }
    public function destroy($id){
        $prize = Prize::findOrFail($id)->delete();
        return to_route('prizes.index');
    }
}
