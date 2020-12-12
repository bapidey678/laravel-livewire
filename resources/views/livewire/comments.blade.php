{{--<div>--}}
{{--    <h1 class="text-3x">Comments</h1>--}}
{{--    @error('newComment')--}}
{{--    <span class="text-red-500 text-xs">--}}
{{--        {{ $massage }}--}}
{{--    </span>--}}
{{--    @enderror--}}
{{--</div>--}}
{{--<section>--}}
{{--    @if($image)--}}
{{--        <img src="{{ $image }}" width="200">--}}
{{--    @endif--}}
{{--        <input type="file" id="image wire:change=$emit('fileChosen')">--}}
{{--</section>--}}
<div class="w-2/3 mx-auto my-4">
    <h2 class="mx-auto w-max block text-2xl">Comments</h2>

    <p class="my-10 mb-3 text-xl text-black">{{ $newComment }}</p>

    @error('newComment')
    <div class="mt-3 text-red-500">{{ $message }}</div>
    @enderror

    @if (session()->has('message'))
        <div class="bg-yellow-600 text-center mb-5 rounded p-2 text-white shadow">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('delete'))
        <div class="bg-red-600 text-center mb-5 rounded p-2 text-white shadow">
            {{ session('delete') }}
        </div>
    @endif

    <form wire:submit.prevent="addComment" class="mb-4 flex">
        @csrf
        <input type="text" class="w-full rounded border shadow p-4 mr-2 my-2"
               placeholder="What is in your mind?" wire:model.lazy="newComment">
        <button class="rounded shadow bg-green-500 text-white p-3 m-2 text-2xl"
                type="submit">Submit</button>
    </form>


    @foreach($comments as $comment)
        <div class="rounded border shadow p-3 my-3">
            <i class="fas fa-times text-red-200 hover:text-red-500 float-right"
            wire:click="remove({{ $comment->id }})"></i>
            <div class="flex justify-start my-2">
                <p class="font-blog text-lg">
{{--                    {{ dd($comment) }}--}}
                    {{ $comment['user']['name'] }}
                </p>
                <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">
                    {{ $comment['created_at']->diffForHumans() }}
                </p>
            </div>
            <p class="text-gray-800">{{ $comment['body'] }}</p>
        </div>
    @endforeach
    {{ $comments->links() }}
</div>
