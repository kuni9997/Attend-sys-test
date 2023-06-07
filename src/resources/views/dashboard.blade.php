<x-app-layout>
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endsection

    <main class="h-full flex items-center justify-center">
        <div class="content-home h-full grid  gap-16 grid-rows-6 grid-cols-2">
            <div class="header__user row-start-1 row-end-1 col-start-1 col-end-3 flex items-center justify-center bg-opacity-100" >
                <p class="text-3xl font-bold text-center">{{ Auth::user()->name }}さんお疲れ様です！</p>
            </div>

            <div class="button-area__working-start row-start-2 row-end-4 col-start-1 col-end-2 bg-white rounded flex items-center justify-center">
                @if($working_st_switch == 1)
                <form action="/dashboard/working" method="get" class="w-full h-full">
                    @csrf
                    <input type="submit" value="勤務開始" class="w-full h-full text-3xl font-bold text-center cursor-pointer">
                </form>
                @else
                <p class="w-full cursor-not-allowed text-3xl font-bold text-center text-gray-400">勤務開始</p>
                @endif
            </div>

            <div class="button-area__working-end row-start-2 row-end-4 col-start-2 col-end-3 bg-white rounded flex items-center justify-center">
                @if($working_end_switch == 1)
                    <form action="/dashboard/working" method="post" class="w-full h-full">
                    @csrf
                    <input type="submit" value="勤務終了" class="w-full h-full text-3xl font-bold text-center cursor-pointer cursor-pointer">
                </form>
                @else
                <p class="w-full cursor-not-allowed text-3xl font-bold text-center text-gray-400 ">勤務終了</p>
                @endif
            </div>

            <div class="button-area__breaking-start row-start-4 row-end-6 col-start-1 col-end-2 bg-white rounded flex items-center justify-center">
                @if($break_time_switch == 1)
                <form action="/dashboard/break" method="get" class="w-full h-full">
                    @csrf
                    <input type="submit" value="休憩開始" class="w-full h-full text-3xl font-bold text-center cursor-pointer">
                </form>
                @else
                <p class="w-full cursor-not-allowed text-3xl font-bold text-center text-gray-400 ">休憩開始</p>
                @endif
            </div>

            <div class="button-area__breaking-end row-start-4 row-end-6 col-start-2 col-end-3 bg-white rounded flex items-center justify-center">
                @if($break_time_switch == 2)
                <form action="/dashboard/break" method="post" class="w-full h-full">
                    @csrf
                    <input type="submit" value="休憩終了" class="w-full h-full text-3xl font-bold text-center cursor-pointer">
                </form>
                @else
                <p class="w-full cursor-not-allowed text-3xl font-bold text-center text-gray-400 ">休憩終了</p>
                @endif
            </div>
        </div>
    </main>

</x-app-layout>
