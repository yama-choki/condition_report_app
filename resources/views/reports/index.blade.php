<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>株式会社クローバーシステムズ：体調管理システム</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="bg-backgroundImage min-h-screen bg-cover">
        <header class="bg-indigo-500 fixed w-full z-10">
            <div class="container mx-auto flex justify-between">
                <div class="text-2xl font-bold text-white py-4 px-2">
                    体調報告システム
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 hover:border-gray-200 focus:outline-none focus:text-gray-400 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ $loginUser->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('ログアウト') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
        </header>

        <main>
            <div class="container mx-auto md:flex border-spacing-8 snap-y h-screen">
                <form action="/reports" method="post" class="md:w-1/3 pt-20 px-2">
                @csrf
                    <div class="bg-white p-2 border-2 border-indigo-100 rounded-lg drop-shadow-md" >
                        <div>
                            <div>
                                <input value="{{$loginUser->name}}" type="hidden" name="name"class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <input value="{{$loginUser->id}}" type="hidden" name="userId"class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <label for="">体調</label><br>
                            @if (!isset($latestReport[0]))
                            <select name="condition" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="0">異常なし</option>
                                <option value="1">咳、くしゃみ</option>
                                <option value="2">発熱</option>
                                <option value="3">その他</option>
                            </select>
                            @else
                            <select name="condition" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="0" {{ $latestReport[0]->condition === 0 ? 'selected' : ''; }}>異常なし</option>
                                <option value="1" {{ $latestReport[0]->condition === 1 ? 'selected' : ''; }}>咳、くしゃみ</option>
                                <option value="2" {{ $latestReport[0]->condition === 2 ? 'selected' : ''; }}>発熱</option>
                                <option value="3" {{ $latestReport[0]->condition === 3 ? 'selected' : ''; }}>その他</option>
                            </select>
                            @endif
                        </div>
                        <div>
                            <label for="">体温</label><br>
                            <input type="text" name="temperature" placeholder="（例）36.5" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div>
                            <label for="">家族等</label><br>
                            @if (!isset($latestReport[0]))
                            <select name="family" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="0">--</option>
                                <option value="1">異常なし</option>
                                <option value="2">同居人が体調不良</option>
                                <option value="3">親戚等が体調不良</option>
                            </select>
                            @else
                            <select name="family" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option value="0" {{ $latestReport[0]->family === 0 ? 'selected' : ''; }}>--</option>
                                <option value="1" {{ $latestReport[0]->family === 1 ? 'selected' : ''; }}>異常なし</option>
                                <option value="2" {{ $latestReport[0]->family === 2 ? 'selected' : ''; }}>同居人が体調不良</option>
                                <option value="3" {{ $latestReport[0]->family === 3 ? 'selected' : ''; }}>親戚等が体調不良</option>
                            </select>
                            @endif

                        </div>
                        <div class="">
                            <label for="">その他</label><br>
                            <textarea name="text" id="" cols="30" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="100文字以下で入力してください">{{ old('text') }}</textarea>
                        </div>
                        @php
                        $date= date("Y-m-d");
                        @endphp
                        @if (isset($latestReport[0]))
                            @if ($latestReport[0]->created_date === $date)
                                <div class="text-indigo-500">本日は既に報告しています。</div>
                            @else
                                <button class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">報告する</button>
                            @endif
                        @else
                            <button class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">報告する</button>
                        @endif
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    </div>
                </form>

                <div class="p-4 md:w-2/3 md:mt-20 overflow-auto h-4/5">
                    <p class="font-bold text-lg opacity-100">投稿履歴</p>
                    <ul class="overflow-y-auto">
                        @foreach ($groupedReports as $reports)
                            <li class="bg-white mb-2 p-2 rounded-md shadow-md border-2 border-indigo-300 hover:bg-indigo-100">
                                <a href="{{ route('reports.show',[ 'id' => $reports[0]->created_date ]); }}">
                                    <div class="">
                                        <div class="flex">
                                            <div class="font-bold text-indigo-600">
                                                {{ $reports[0]->created_date }}
                                            </div>
                                            <div class="text-sm pt-0.5">
                                                　最後の投稿：
                                                <span class="">
                                                    {{ $reports[0]->created_at->format('H:i') }}　
                                                </span>
                                                <span class="font-bold">
                                                    {{ $reports[0]->user_name }}
                                                </span>
                                            </div>

                                        </div>
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
                        <div class="h-8 md:hidden"></div>
                    </ul>
                </div>

            </div>
        </main>
        <footer class="bg-indigo-500 fixed bottom-0 left-0 w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="py-4 text-center">
                    <p class="text-white text-sm">株式会社クローバーシステムズ</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>