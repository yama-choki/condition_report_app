<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>株式会社クローバーシステムズ：体調管理システム</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-200">
    <div>
        <header class="bg-indigo-500 fixed w-full z-10">
            <div class="container mx-auto flex justify-between">
                <div class="text-2xl font-bold text-white py-4 px-2">
                    体調報告システム
                </div>

                <nav x-data="{ open: false }">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-indigo-500">
                        <div class="flex justify-between h-16">
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-white hover:text-gray-200 hover:border-gray-200 focus:outline-none focus:text-gray-200 focus:border-gray-300 transition duration-150 ease-in-out">
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
                                                {{ __(' ログアウト') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>

                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button @click="open = ! open" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200">
                            <div class="px-4">
                                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                                <div class="font-medium text-sm text-gray-300">{{ Auth::user()->email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" >
                                    @csrf

                                    <x-responsive-nav-link :href="route('login')" class="text-white"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('ログアウト') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <div class="main-box container mx-auto border-spacing-8 pt-20 px-2 md:flex">
                <div class="md:w-1/4 bg-white p-2 border-2 border-indigo-200 rounded-lg drop-shadow-md" style="max-height:360px">
                    <div class="text-lg font-bold text-center mb-4">社員リスト</div>
                    <ul>
                        @foreach ($userNames as $userName)
                        <li>
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

                <div class="p-2 md:w-3/4 overflow-auto">
                    <p class="font-bold text-xl">投稿履歴:{{ $day }}</p>
                    <ul class="overflow-auto">
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
                                <div class="flex text-sm">
                                    <div class="condition-box">
                                        <span class="font-bold text-gray-700">体調：</span>
                                        @if($report->condition === 0)異常なし　@endif
                                        @if($report->condition === 1)咳、くしゃみ　@endif
                                        @if($report->condition === 2)発熱　@endif
                                        @if($report->condition === 3)その他　@endif
                                    </div>
                                    <div class="family-box">
                                        <span class="font-bold text-gray-700">家族：</span>
                                        @if($report->family === 0)ーー　@endif
                                        @if($report->family === 1)異常なし　@endif
                                        @if($report->family === 2)同居人が体調不良　@endif
                                        @if($report->family === 3)親戚等が体調不良　@endif
                                    </div>
                                    <div class="max-[450px]:hidden temperature">
                                        <span class="font-bold text-gray-700">体温：</span>
                                        {{ $report->temperature }}℃
                                    </div>
                                </div>
                                <div class="min-[449px]:hidden temperature">
                                    <span class="font-bold text-gray-700">体温：</span>
                                    {{ $report->temperature }}℃
                                </div>
                                @if($report->text)
                                    <div class="text-sm w-full">
                                        <span class="font-bold text-gray-700">その他:</span>
                                        {{ $report->text }}
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div style="height:64px;"></div>
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