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
                <div class="text-lg md:text-2xl font-bold text-white py-4 px-2">
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
            <div class="container mx-auto border-spacing-8 snap-y h-screen md:flex">
                <form action="{{ route('reports.index') }}" method="post" class="md:w-1/3 pt-20 px-2">
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
                        <div>
                            <div class="flex justify-between">
                                <label for="">その他</label> <span id="inputlength" class="text-xs text-gray-800"></span>
                            </div>
                            <textarea name="text" id="" cols="30" onkeyup="ShowLength(value);" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" placeholder="100文字以下で入力してください">{{ old('text') }}</textarea>
                        </div>
                        @php
                        $date= date('Y-m-d');
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

                <div class="p-2 md:w-2/3 md:mt-20 overflow-auto h-4/5">
                    <p class="font-bold text-lg opacity-100">投稿履歴</p>
                    <ul class="overflow-y-auto">
                        @foreach ($groupedReports as $reports)
                            <li class="bg-white mb-2 p-2 rounded-md shadow-md border-2 border-indigo-300 hover:bg-indigo-100">
                                <a href="{{ route('reports.show',[ 'id' => $reports[0]->created_date ]); }}">
                                    <div>
                                        <div class="flex justify-between">
                                            <div class="font-bold text-indigo-500 w-1/3">{{ $reports[0]->created_date }}</div>
                                            <div class="text-sm pt-1">{{ $reports[0]->created_at->format('H:i') }}</div>
                                        </div>
                                        <div class="font-bold">{{ $reports[0]->user_name }}</div>
                                        <div class="flex text-sm">
                                            <div>
                                                <span class="font-bold text-gray-700">体調：</span>
                                                @if($reports[0]->condition === 0)異常なし　@endif
                                                @if($reports[0]->condition === 1)咳、くしゃみ　@endif
                                                @if($reports[0]->condition === 2)発熱　@endif
                                                @if($reports[0]->condition === 3)その他　@endif
                                            </div>
                                            <div>
                                                <span class="font-bold text-gray-700">家族：</span>
                                                @if($reports[0]->family === 0)ーー　@endif
                                                @if($reports[0]->family === 1)異常なし　@endif
                                                @if($reports[0]->family === 2)同居人が体調不良　@endif
                                                @if($reports[0]->family === 3)親戚等が体調不良　@endif
                                            </div>
                                            <div class="max-[430px]:hidden">
                                                <span class="font-bold text-gray-700">体温：</span>
                                                {{ $reports[0]->temperature }}℃
                                            </div>
                                        </div>
                                        <div class="min-[429px]:hidden text-sm">
                                            <span class="font-bold text-gray-700">体温：</span>
                                            {{ $reports[0]->temperature }}℃
                                        </div>
                                        @if($reports[0]->text)
                                        <div class="text-sm w-full">
                                            <span class="font-bold text-gray-700">その他:</span>
                                            {{ $reports[0]->text }}</div>
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
<script>
    function ShowLength( str ) {
       document.getElementById("inputlength").innerHTML = str.length + "/100";
    }
</script>
</html>