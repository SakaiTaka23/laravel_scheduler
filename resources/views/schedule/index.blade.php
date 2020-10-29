<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>新規作成</h2>
                <form action='{{ route('schedule.create') }}' method="GET">
                    <label for='place'>場所</label>
                    <input type='text' name='place' id='place' value='test' required>

                    <label for='content'>内容</label>
                    <input type='text' name='content' id='content' value='test' required>

                    <label for='begin'>開始</label>
                    <input type='date' name='begin' id='begin' value="2020-11-11" required>

                    <label for='end'>終了</label>
                    <input type='date' name='end' id='end' value="2020-11-11" required>

                    <button type='submit'>作成</button>
                </form>

                <h2>スケジュール一覧</h2>

                <table>
                    <thead>
                        <tr>
                            <th>place</th>
                            <th>content</th>
                            <th>begin</th>
                            <th>end</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule['place'] }}</td>
                            <td>{{ $schedule['content'] }}</td>
                            <td>{{ $schedule['begin'] }}</td>
                            <td>{{ $schedule['end'] }}</td>
                            <td>
                                <a href='{{ route('schedule.edit',['schedule'=>$schedule]) }}'>更新</a>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('schedule.destroy',['schedule'=>$schedule]) }}">
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
</x-app-layout>