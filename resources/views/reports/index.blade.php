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
            <div class="text-white">
                {{ $user->name }}
            </div>
        </div>
    </header>
    <main>
        <div class="bg-pink-100 container mx-auto md:flex border-spacing-8">
            <form action="/reports" method="post" class="md:w-1/3">
            @csrf
                <div class="bg-white p-2 border-2 border-indigo-100 rounded-lg drop-shadow-md" >
                    <div>
                    <div>
                        <input value="{{$user->name}}" type="hidden" name="userName"class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                        <label for="">体調</label><br>
                        <select name="condition" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="0">異常なし</option>
                            <option value="1">咳、くしゃみ</option>
                            <option value="2">発熱</option>
                            <option value="3">その他</option>
                        </select>
                    </div>
                    <div>
                        <label for="">体温</label><br>
                        <input type="text" name="temperature"class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div>
                        <label for="">家族等</label><br>
                        <select name="family" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="0">--</option>
                            <option value="1">異常なし</option>
                            <option value="2">同居人が体調不良</option>
                            <option value="3">親戚等が体調不良</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="">その他</label><br>
                        <textarea name="text" id="" cols="30" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                    <button class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">報告する</button>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
            </form>

            <div class="bg-indigo-100 p-4 md:w-2/3">
                <p class="font-bold text-lg">投稿履歴</p>
                <div class="bg-scroll"></div>
                <!-- {{ $groupedReports }} -->
                <ul class="">
                    @foreach ($groupedReports as $reports)
                        <li class>
                            <a href="/reports/{{ $reports[0]->created_date }}" class="">
                                <div class="hover:bg-indigo-200">
                                    <span href="" class="font-bold text-indigo-600">{{ $reports[0]->created_date }}</span>
                                    <span class="text-sm">　最後の投稿：{{ $reports[0]->created_at }}　{{ $reports[0]->user }}</span>
                                    <p class="text-sm">
                                        @if($reports[0]->condition === 0)
                                        <span>体調：異常なし　</span>
                                        @endif
                                        @if($reports[0]->condition === 1)
                                        <span>体調：咳、くしゃみ　</span>
                                        @endif
                                        @if($reports[0]->condition === 2)
                                        <span>体調：発熱　</span>
                                        @endif
                                        @if($reports[0]->condition === 3)
                                        <span>体調：その他　</span>
                                        @endif
                                        @if($reports[0]->family === 0)
                                        <span>家族：ーー　</span>
                                        @endif
                                        @if($reports[0]->family === 1)
                                        <span>家族：異常なし　</span>
                                        @endif
                                        @if($reports[0]->family === 2)
                                        <span>家族：同居人が体調不良　</span>
                                        @endif
                                        @if($reports[0]->family === 3)
                                        <span>家族：親戚等が体調不良　</span>
                                        @endif
                                        <span>体温：{{ $reports[0]->temperature }}℃</span>
                                    </p>
                                    @if($reports[0]->text)
                                    <div class="text-sm w-full">その他：{{ $reports[0]->text }}</div>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </main>
</body>
</html>