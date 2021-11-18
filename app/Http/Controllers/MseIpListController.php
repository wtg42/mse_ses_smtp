<?php

namespace App\Http\Controllers;

use App\Models\MseIpList;
use Illuminate\Http\Request;
use App\Http\Resources\MseIpListResource;
use Symfony\Component\HttpFoundation\Response;

class MseIpListController extends Controller
{
    // 表單欄位
    // public $ipv4;
    // public $name;

    // form reuls 搭配 messages
    protected $rules = [
        'ipv4' => 'required|string|unique:mse_ip_lists',
        'name' => 'required|string|min:2',
    ];

    protected $messages = [
        'ipv4.unique' => 'IP 已被存在',
        'ipv4.required' => '請填入 IP',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mseIpList = MseIpList::get();
        if ($mseIpList->isEmpty()) {
            return response()->json(['Opps! data is empty.'], 404);
        }
        // return response($mseIpList, Response::HTTP_OK);
        return MseIpListResource::collection($mseIpList)->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $this->validate($request, $this->rules, $this->messages);
            $ip = MseIpList::create([
                'ipv4' => $validatedData['ipv4'],
                'name' => $validatedData['name'],
            ]);
            $ip->save();
            return response()->json(['msg' => 'Done'])->setStatusCode(Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([$th->getMessage()])->setStatusCode(Response::HTTP_CONFLICT);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
