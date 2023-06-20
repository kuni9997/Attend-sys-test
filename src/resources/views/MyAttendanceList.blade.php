<x-app-layout>
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/AttendanceList.css') }}">
    @endsection

    <main class="w-full h-full">
        <div class="content-home max-w-full h-full flex flex-col justify-center items-center">
                <div class="auth-name flex justify-center items-center">
                    <p class="auth-name__item text-2xl font-bold">{{ Auth::user()->name }}さんの勤怠一覧</p>
                </div>
                <div class="date-display w-full flex justify-center items-center">
                <form action="/myRecord" method="get" class="day-to-day">
                @csrf
                    <input type="submit" class="date-display__yesterday w-full cursor-pointer" value="<" name="yesterday">
                    <input type="hidden" name="date" value="{{ $date1->modify('-1day')->format('Y-m-d') }}">
                </form>
                    <p type="" class="date-display__header" name="date">{{ $date2->format('Y-m-d') }}</p>
                <form action="/myRecord" method="get" class="day-to-day">
                @csrf
                    <input type="submit" class="date-display__next-day w-full cursor-pointer" value=">" name="nextDay">
                    <input type="hidden" name="date" value="{{ $date3->modify('+1day')->format('Y-m-d') }}">
                </form>
            </div>
            <div class="record-list">
                <table class="w-full h-full">
                    <tbody class="w-full h-full grid grid-rows-6">
                        <tr class="table__header w-full row-span-1 grid grid-cols-5 font-bold text-xl justify-center items-center">
                            <th class="table__item--name">名前</th>
                            <th>勤務開始</th>
                            <th>勤務終了</th>
                            <th>休憩時間</th>
                            <th>勤務時間</th>
                        </tr>
                        @foreach($users as $user)
                            @foreach($user->Attendances as $Attendance)
                            <tr class="table__item w-full grid grid-cols-5 text-xl justify-center items-center">
                                <th class="table__item--name">{{ $user->name }}</th>
                                <th>{{ $Attendance->working_st->format('H:i:s')}}</th>
                                @if( $Attendance->working_end != NULL)
                                    <th>{{ $Attendance->working_end->format('H:i:s')}}</th>
                                @else
                                    <th>00:00:00</th>
                                @endif
                                @if($Attendance->breakTimes->isEmpty())
                                    <th>00:00:00</th>
                                @else
                                    @foreach($Attendance->breakTimes as $breakTime)
                                        <th>{{ $breakTime->result }}</th>
                                        @break
                                    @endforeach
                                @endif
                                @if( $Attendance->working_end != NULL)
                                    <th>{{ $Attendance->result }}</th>
                                @else
                                    <th>00:00:00</th>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</x-app-layout>