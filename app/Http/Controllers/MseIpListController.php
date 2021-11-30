<?php

namespace App\Http\Controllers;

use App\Models\MseIpList;
use Illuminate\Http\Request;
use App\Mail\BasicTextSampleMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\MseIpListResource;
use App\Jobs\MseSendMailJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

class MseIpListController extends Controller
{
    // 表單欄位
    // public $ipv4;
    // public $name;

    // form reuls 搭配 messages
    protected $rules = [
        'ipv4' => 'required|ipv4|unique:mse_ip_lists',
        'name' => 'required|string|min:2',
    ];

    protected $messages = [
        'ipv4.unique' => 'IP 已存在',
        'ipv4.required' => '請填入 IP',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mseIpList = Cache::remember('mse_ip_list', 60, function () {
            return MseIpList::get();
        });
        if ($mseIpList->isEmpty()) {
            return response()->json(['err_msg' => 'Opps! data is empty.'], 404);
        }
        return MseIpListResource::collection($mseIpList)
        ->response()
        ->setStatusCode(Response::HTTP_OK);
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
            MseIpList::create([
                'ipv4' => $validatedData['ipv4'],
                'name' => $validatedData['name'],
            ])->save();
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

    /**
     * 打信到 BasicTextSampleMail
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws InvalidArgumentException
     */
    public function sendMail(Request $request)
    {
        $rules = [
            'ip' => 'required|ipv4',
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|string',
            'contents' => 'required|string',
        ];
        $messages = [
            'ip.required' => '請選擇打信 IP',
            'from.required' => '請填入 Email',
            'to.required' => '請填入 Email',
            'subject.required' => '請填入主旨',
            'contents.required' => '請填入信件內容',
        ];
        $validatedData = $this->validate($request, $rules, $messages);

        Mail::queue(new BasicTextSampleMail($validatedData));
        return response()->json(['msg' => 'Done'])->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws InvalidArgumentException
     */
    public function jobQueue(Request $request)
    {
        MseSendMailJob::dispatch();
        return response()->json(['msg' => 'Done'])->setStatusCode(Response::HTTP_OK);
    }
}
