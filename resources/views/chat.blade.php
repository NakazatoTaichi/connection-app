@extends('layouts.layout');

@section('title','チャット画面')

@section('main')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="overflow-scroll" style="height: 600px;">
                <div id="scroll-inner">
                    @foreach ($messages as $message)
                        <div class="message-container {{ $message->user_id === auth()->user()->id ? 'text-end' : 'text-start' }}">
                            <div class="{{ $message->user_id === auth()->user()->id ? 'sent-message' : 'received-message' }}">
                                {{ $message->message }}
                            </div>
                            <div class="timestamp">{{ $message->created_at->format('G:i') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom-input">
        <form id="chat-form" method="POST" action="{{ route('chat.send', $user) }}">
            @csrf
            <div class="input-group">
                <input type="text" name="message" class="form-control" placeholder="メッセージを入力" aria-label="メッセージを入力" aria-describedby="button-send" style="min-height: 50px;">
                <button class="btn btn-primary" type="submit" id="button-send">送信</button>
            </div>
        </form>
    </div>
</div>
    <style>
        /* 追加のスタイル設定 */
        .message-container {
            margin-bottom: 10px;
        }
        .received-message {
            background-color: #f0f0f0;
            border-radius: 10px;
            padding: 10px;
            width: fit-content;
            max-width: 50%;
            word-wrap: break-word;
            margin-left: 0;
            font-size: 24px;
        }
        .sent-message {
            background-color: #3490dc;
            border-radius: 10px;
            padding: 10px;
            color: #fff;
            width: fit-content;
            max-width: 50%;
            word-wrap: break-word;
            margin-left: auto;
            font-size: 24px;
            /* direction: rtl; */
            text-align: left;
        }
        .timestamp {
            color: #777;
        }
        .fixed-bottom-input {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 40px;
            margin-bottom: 20px;
            background-color: #fff;
            border-top: 1px solid #ddd;
        }
    </style>
    <script>
        let target = document.getElementById('scroll-inner');
        target.scrollIntoView(false);
    </script>
@endsection
