<?php

namespace App\Http\Controllers;

use App\Http\Requests\PushNotificationRequest;
use App\Models\PushNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){ 
            $data = PushNotification::orderBy('id','desc')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data){
                        $actionBtn = '<button id="" data-id="'.$data->id.'" class="form_delete delete btn btn-danger btn-sm">Delete</button>';
                        return $actionBtn;
                    })
                    ->addColumn('push_image', function($data){
                        $img = Storage::disk('s3')->url($data->image);
                        $actionBtn =  '<img src='.$img.' border="0" width="40" class="img-rounded" align="center" />';
                        return $actionBtn;
                    })
                    ->rawColumns(['action','push_image']) // returning action column
                    ->make(true);
        }
        return view('administrator.push_notifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PushNotificationRequest $request)
    {
        $image_url = ($request->image) ? $cover = Storage::disk('s3')->put('push_notifications', $request->image, 'public') : '';
        PushNotification::create([
            'title' => $request->title,
            'body' => $request->message,
            'image' => $image_url,
        ]);
        $device_ids = User::whereNotNull('device_id')->pluck('device_id')->all();
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => 1,'status'=>"done");
        // $notification = array('title' =>$request->title, 'text' => $request->message, 'sound' => 'default', 'badge' => '1',);
        // $arrayToSend = array('registration_ids' => $device_id, 'notification' => $notification,'data' => $dataArr, 'priority'=>'high');
        // $fields = json_encode ($arrayToSend);
        $data = [
            "registration_ids" => $device_ids,
            "notification" => [
                "title" => $request->title,
                "body" => $request->message,  
                'image'=> Storage::disk('s3')->url($image_url)
            ]
        ];
        $encodedData = json_encode($data);
        $headers = array (
            'Authorization: key=' . "AAAA2jKpaNk:APA91bFkjKVLsddVl6rRm_yHNboCga-oTNtJUjrV3GoSSE-hm9DUX7HFtOc3pnHYnVpfIGcVWxdlMGRDikiJQSyh6VzOn1CYO7HUA7r7F9tqzGcLFLdTPDsQWItGjWSLVX987fxWK1qc",
            'Content-Type: application/json'
        );

        $ch = curl_init (); 
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $encodedData );

        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );
        $message = ($result) ? "Push Notification Sent" : "Cannot Send Push Notification at the moment";
        // return response()->json(["message" => 'zz']);
        return response()->json($message, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function show(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(PushNotification $pushNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PushNotification $pushNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PushNotification  $pushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(PushNotification $pushNotification)
    {
        //
    }
}
