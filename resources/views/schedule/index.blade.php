<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>スケジュール一覧</h2>
                <a href='#'>新規作成</a>
                
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
                            <td>{{ $schdeule['end'] }}</td>
                            <td><a href='#'>更新</a></td>
                            <td>
                                <form method="POST" action="#">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">削除</button>
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