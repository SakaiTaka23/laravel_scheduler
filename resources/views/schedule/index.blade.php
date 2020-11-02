<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class='py-12'>
                    <h1 class="font-black">新規作成</h1>
                    <form action='{{ route('schedule.create') }}' method="GET">

                        <label for='place'>場所</label>
                        <input type='text' name='place' id='place' value='test' required>

                        <label for='content'>内容</label>
                        <input type='text' name='content' id='content' value='test' required>

                        <label for='begin'>開始</label>
                        <input type='date' name='begin' id='begin' value="2020-11-11" required>

                        <label for='end'>終了</label>
                        <input type='date' name='end' id='end' value="2020-11-11" required>

                        <button type='submit'
                            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                            onclick="window.checkdate()">作成</button>
                    </form>
                </div>

                <h2 class="font-black">スケジュール一覧</h2>
                <div class='flex flex-auto justify-around pb-12'>
                    <h2 class='my-3 py-3'><a href='{{ route('schedule.index') }}'
                            class="bg-transparent hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded">全表示</a>
                    </h2>
                    <h2 class='my-3 py-3'><a href='{{ route('ScheduleMonth') }}'
                            class="bg-transparent hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded">月間表示</a>
                    </h2>
                    <h2 class='my-3 py-3'><a href='{{ route('ScheduleWeek') }}'
                            class="bg-transparent hover:bg-teal-500 text-teal-700 font-semibold hover:text-white py-2 px-4 border border-teal-500 hover:border-transparent rounded">週間表示</a>
                    </h2>
                </div>

                <div class='flex justify-center'>
                    <table class='table-auto'>
                        <thead>
                            <tr>
                                <th class='px-4 py-2'>place</th>
                                <th class='px-4 py-2'>content</th>
                                <th class='px-4 py-2'>begin</th>
                                <th class='px-4 py-2'>end</th>
                                <th class='px-4 py-2'></th>
                                <th class='px-4 py-2'></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                            <tr>
                                <td class='border px-4 py-2'>{{ $schedule['place'] }}</td>
                                <td class='border px-4 py-2'>{{ $schedule['content'] }}</td>
                                <td class='border px-4 py-2'>{{ $schedule['begin'] }}</td>
                                <td class='border px-4 py-2'>{{ $schedule['end'] }}</td>
                                <td class='border px-4 py-2 text-green-600'>
                                    <a href='{{ route('schedule.edit',['schedule'=>$schedule]) }}'>更新</a>
                                </td>
                                <td class='border px-4 py-2 text-red-600'>
                                    <form method="POST"
                                        action="{{ route('schedule.destroy',['schedule'=>$schedule]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">削除</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function checkdate()
    {
    console.log('check');
    begin = document.getElementById('begin').value;
    end = document.getElementById('end').value;
    if (begin > end)
    {
    tmp = begin;
    document.getElementById('begin').value = end;
    document.getElementById('end').value = tmp;
    }
    }
</script>