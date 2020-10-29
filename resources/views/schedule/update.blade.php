<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedule Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action='{{ route('schedule.update',['schedule'=>$schedule['id']]) }}' method="POST">
                    @method("PUT")
                    @csrf
                    <label for='place'>場所</label>
                    <input type='text' name='place' id='place' value="{{ $schedule['place'] }}" required>

                    <label for='content'>内容</label>
                    <input type='text' name='content' id='content' value="{{ $schedule['content'] }}" required>

                    <label for='begin'>開始</label>
                    <input type='date' name='begin' id='begin' value="{{ $schedule['begin'] }}" required>

                    <label for='end'>終了</label>
                    <input type='date' name='end' id='end' value="{{ $schedule['end'] }}" required>

                    <button type='submit'>更新</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>