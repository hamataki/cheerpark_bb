<!-- resources/views/tweets/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Monologue一覧') }}
    </h2>
  </x-slot>

 <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @foreach ($tweets as $tweet)
                <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <p class="text-gray-800 dark:text-gray-300 whitespace-pre-wrap" id="tweet_{{ $tweet->id }}"></p>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                        // JSONエンコードを使用して、特殊文字を適切にエスケープ
                        var tweetText = @json($tweet->tweet);
                        // テキストを35文字ごとに改行
                        var formattedText = tweetText.replace(/(.{35})/g, '$1\n');
                        document.getElementById('tweet_{{ $tweet->id }}').textContent = formattedText;
                        });
                    </script>
                    <a href="{{ auth()->id() === $tweet->user->id ? route('tweets.mypage') : route('profile.show', $tweet->user->id) }}">
                        投稿者: {{ $tweet->user->name }}
                        <img src="{{ $tweet->user->profile_image }}" alt="{{ $tweet->user->name }}" class="text-gray-600 dark:text-gray-400 text-sm">
                    </a>
                    <a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
                    <div class="flex">
                        @if ($tweet->liked->contains(auth()->id()))
                        <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">{{ $tweet->liked->count() }}</button>
                        </form>
                        @else
                        <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-blue-500 hover:text-blue-700">❤️ {{ $tweet->liked->count() }}</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</x-app-layout>


