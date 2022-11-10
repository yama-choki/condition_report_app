<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite('resources/css/app.css')
</head>
<body>
    <header class="bg-indigo-500">
        <div class="container mx-auto">
            <div class="text-2xl font-bold text-white">
                体調報告システム
            </div>
            <div>

            </div>
        </div>
    </header>
    <main>
        <div class="bg-pink-100 container mx-auto md:flex border-spacing-8">
            <div>
                <p>登録社員</p>
                <ul>
                   @foreach ($userNames as $userName)
                   <li>
                        @foreach ($selectedReports as $report)
                            @if ($userName->name == $report->user)
                                <input type="checkbox" checked>
                            @else
                                <input type="checkbox">
                            @endif
                        @endforeach
                        {{ $userName->name }}
                   </li>
                   @endforeach
                </ul>
            </div>


            <div class="bg-indigo-100 p-4 md:w-2/3">
                <p class="font-bold text-xl">投稿履歴</p>
                {{ $selectedReports }}
                <ul class="">
                    @foreach ($selectedReports as $report)
                        <li class>
                            <span class="font-bold text-indigo-500">{{$report->user}}　</span>
                            <span class="text-sm">{{$report->created_at}}</span>
                            <p class="text-sm">
                                @if($report->condition === 0)
                                <span>体調：異常なし　</span>
                                @endif
                                @if($report->condition === 1)
                                <span>体調：咳、くしゃみ　</span>
                                @endif
                                @if($report->condition === 2)
                                <span>体調：発熱　</span>
                                @endif
                                @if($report->condition === 3)
                                <span>体調：その他　</span>
                                @endif

                                @if($report->family === 0)
                                <span>家族：ーー　</span>
                                @endif
                                @if($report->family === 1)
                                <span>家族：異常なし　</span>
                                @endif
                                @if($report->family === 2)
                                <span>家族：同居人が体調不良　</span>
                                @endif
                                @if($report->family === 3)
                                <span>家族：親戚等が体調不良　</span>
                                @endif
                                <span>体温：{{ $report->temperature }}℃</span>
                            </p>
                            @if($report->text)
                                <div class="text-sm w-full">その他：{{ $report->text }}</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </main>
</body>
</html>