<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>株式会社クローバーシステムズ：体調管理システム</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-green-300">
    <div>
        <header class="bg-indigo-500 fixed w-full z-10">
            <div class="container mx-auto flex justify-between">
                <div class="text-2xl font-bold text-white py-4 px-2">
                    体調報告システム
                </div>
                <!-- <div class="text-lg font-bold text-white py-4 px-2">
                    {{ $loginUser->name }}
                </div> -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 hover:border-gray-200 focus:outline-none focus:text-gray-300 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

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
            </div>
        </header>

        <main>
            <div class="container mx-auto border-spacing-8 md:flex pt-20 px-2">
                <div class="md:w-1/4 bg-white p-2 border-2 border-indigo-200 rounded-lg drop-shadow-md">
                    <div class="text-lg font-bold text-center mb-4">社員リスト</div>
                    <ul class="h-auto">
                       @foreach ($userNames as $userName)
                       <li class="">
                           <div class="flex my-1 ">
                               <div class="w-1/6">
                                    @foreach ($selectedReports as $report)
                                        @if ($userName->name == $report->user_name)
                                            <input type="checkbox" checked disabled class="ml-6 mb-0.5">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="font-bold ml-2 md:ml-4">
                                    {{ $userName->name }}
                                </div>
                           </div>
                       </li><hr>
                       @endforeach
                    </ul>
                </div>

                <div class="p-4 md:w-3/4">
                    <p class="font-bold text-xl">投稿履歴</p>
                    <ul class="">
                        @foreach ($selectedReports as $report)
                            <li class="bg-white mb-2 p-2 rounded-md shadow-md border-2 border-indigo-300">
                                <div class="flex justify-between">
                                    <div>
                                        <span class="font-bold text-indigo-500">{{$report->user_name}}　</span>
                                        <span class="text-sm">投稿：{{$report->created_at->format('H:i')}}</span>
                                    </div>
                                    @if ($loginUser->id === $report->user_id)
                                        <form onsubmit="return deleteReport();"
                                            action="{{ route('reports.destroy', ['id' => $report->id] ) }}" method="post"
                                            class="inline-block text-white text-sm"
                                            role="menuitem" tabindex="-1">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="bg-indigo-500 rounded-md p-1 hover:bg-indigo-600">削除</button>
                                        </form>
                                    @endif
                                </div>
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
                        <div class="h-8  md:hidden"></div>
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
<script>
    function deleteReport() {
        if (confirm('本当に削除しますか？')) {
            return true;
        } else {
            return false;
        }
    }
</script>
</html>