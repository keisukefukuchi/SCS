<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\Channel;
use App\Models\Join;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Message $message)
    {
        $user = auth()->user();

        $channel_id = $request->input('channel_id');
        if (empty($channel_id)){
            $channel_id = 1;
        }

        $timelines = $message->getTimelines($channel_id);

        $join_channels = Join::joinChannelIds($user->id);

        $channels = Channel::getJoinedChannels($join_channels);
        $channel = Channel::where('id', $channel_id)->first();
        $channel_name = $channel->channel_name;

        return view('messages.index', [
            'user'      => $user,
            'reply_id'  => 0,
            'timelines' => $timelines,
            'channels'  => $channels,
            'channel_id'  => $channel_id,
            'channel_name' => $channel_name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Message $message)
    {
        $user = auth()->user();
        $reply_id = $request->input('reply_id');
        $channel_id = $request->input('channel_id');
        //$channel_id = 1;

        $channel = Channel::where('id', $channel_id)->first();
        $channel_name = $channel->channel_name;

        return view('messages.create', [
            'user' => $user,
            'reply_id' => $reply_id,
            'channel_name' => $channel_name,
            'channel_id' => $channel_id,
            'param' => 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Message $message)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'message' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();

        $message->messageStore($user->id, $data);

        return redirect('messages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $user = auth()->user();
        $message = $message->getMessage($message->id);

        // $reply = $message->getMessage($message->reply_id);
        $reply = $message->getReply($message->id);

        return view('messages.show', [
            'user' => $user,
            'message' => $message,
            'reply' => $reply,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        $user = auth()->user();
        $messages = $message->getEditMessage($user->id, $message->id);

        if (!isset($messages)) {
            return redirect('messages');
        }

        return view('messages.create', [
            'user'   => $user,
            'messages' => $messages,
            'channel_name' => null,
            'channel_id' => null,
            'param' => 1,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'message' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $message->messageUpdate($message->id, $data);

        return redirect('messages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $user = auth()->user();
        $message->messageDestroy($user->id, $message->id);

        return redirect('messages');
    }

    public function replyShow(Request $request)
    {
        $user = auth()->user();
        $channel_id = $request->channel_id;
        $channel_name = Channel::find($channel_id);
        $reply_id = $request->reply_id;
        return view('messages.create', [
            'user' => $user,
            'channel_name' => $channel_name->channel_name,
            'channel_id' => $channel_id,
            'reply_id' => $reply_id,
            'param' => 2
        ]);
    }

    public function replyStore(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'message' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();


        $message = new Message();
        $message->messageStore($user->id, $data);

        return redirect('messages');
    }

}
