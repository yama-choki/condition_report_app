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
            <form action="/reports" method="post">
            @csrf
                <div class="bg-white p-2 m-5 border-2 border-indigo-100 rounded-lg drop-shadow-md" >
                    <div>
                        <label for="">体調</label><br>
                        <select name="condition" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="0">選択してください</option>
                            <option value="1">異常なし</option>
                            <option value="2">咳、くしゃみ</option>
                            <option value="3">発熱</option>
                            <option value="4">その他</option>
                        </select>
                    </div>
                    <div>
                        <label for="">体温</label><br>
                        <input type="text" name="temperature"class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div>
                        <label for="">家族等</label><br>
                        <select name="family" id="" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            <option value="0">選択してください</option>
                            <option value="1">--</option>
                            <option value="2">異常なし</option>
                            <option value="3">同居人が体調不良</option>
                            <option value="4">親戚等が体調不良</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="">その他</label><br>
                        <textarea name="text" id="" cols="30" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                    <button class="inline-flex text-white bg-indigo-500 border-0 py-1 px-4 focus:outline-none hover:bg-indigo-600 rounded">報告する</button>
                </div>
            </form>

            <div class="bg-indigo-100 m-5 p-5">
                <p class="font-bold text-lg">投稿履歴</p>
                <div class="bg-scroll"></div>
                <ul class="">
                    <li class>
                        <a href="#" class="">
                            <div class="hover:bg-indigo-200">
                                <span href="" class="font-bold text-indigo-600">11月11日</span>
                                <span class="text-sm">　最後の投稿：9時20分　山﨑大地</span>
                                <p class="text-sm">体調：異常なし　体温：36.0度　家族等：--</p>
                                <p class="text-sm">その他：＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
                            </div>
                        </a>
                    </li>
                    <li class>
                        <a href="#" class="">
                            <div class="hover:bg-indigo-200">
                                <span href="" class="font-bold text-indigo-600">11月11日</span>
                                <span class="text-sm">　最後の投稿:9時20分　投稿者：山﨑大地</span>
                                <p class="text-sm">体調：咳、くしゃみ　体温：36.0度　家族等：同居人等が体調不良</p>
                                <p class="text-sm">その他：＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
                            </div>
                        </a>
                    </li>
                    <li class>
                        <a href="#" class="">
                            <div class="hover:bg-indigo-200">
                                <span href="" class="font-bold text-indigo-600">11月11日</span>
                                <span class="text-sm">　最後の投稿:9時20分　投稿者：山﨑大地</span>
                                <p class="text-sm">体調：異常なし　体温：36.0度　家族等：--</p>
                                <p class="text-sm">その他：＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
                            </div>
                        </a>
                    </li>
                    <li class>
                        <a href="#" class="">
                            <div class="hover:bg-indigo-200">
                                <span href="" class="font-bold text-indigo-600">11月11日</span>
                                <span class="text-sm">　最後の投稿:9時20分　投稿者：山﨑大地</span>
                                <p class="text-sm">体調：異常なし　体温：36.0度　家族等：--</p>
                                <p class="text-sm">その他：＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </main>
</body>
</html>