<!-- resources/views/tweets/show.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Monologue詳細') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <a href="{{ route('tweets.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">一覧に戻る</a>
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
          <a href="{{ auth()->id() === $tweet->user->id ? route('tweets.mypage') : route('tweets.mypage', $tweet->user->id) }}">
            投稿者: {{ $tweet->user->name }}
            <img src="{{ $tweet->user->profile_image }}" alt="{{ $tweet->user->name }}" class="text-gray-600 dark:text-gray-400 text-sm">
          </a>
          <div class="text-gray-600 dark:text-gray-400 text-sm">
            <p>作成日時: {{ $tweet->created_at->format('Y-m-d H:i') }}</p>
            <p>更新日時: {{ $tweet->updated_at->format('Y-m-d H:i') }}</p>
          </div>
           <!--もしログインしている人のidとtweetした人のidが一緒の場合-->
          @if (auth()->id() === $tweet->user_id)
          <div class="flex mt-4">
            <a href="{{ route('tweets.edit', $tweet) }}" class="text-blue-500 hover:text-blue-700 mr-2">編集</a>
            <form action="{{ route('tweets.destroy', $tweet) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
            </form>
          </div>
          @endif
          {{-- 🔽 追加 --}}
          <div class="flex mt-4">
            @if ($tweet->liked->contains(auth()->id()))
            <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-500 hover:text-red-700"> {{$tweet->liked->count()}}</button>
            </form>
            @else
            <form action="{{ route('tweets.like', $tweet) }}" method="POST">
              @csrf
              <button type="submit" class="text-blue-500 hover:text-blue-700">❤️{{$tweet->liked->count()}}</button>
            </form>
            @endif
          </div>
          {{-- 🔼 ここまで --}}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
