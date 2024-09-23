{{-- resources/views/users/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザー一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200">
                    <!-- Flexbox Container -->
                    <div style="display: flex;  justify-content: center; align-items: center; flex-wrap: wrap;">
                        @foreach ($users as $user)
                            <div style="flex: 1 0 21%; margin: 5px; background: #f3f4f6; padding: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                {{ $user->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>





