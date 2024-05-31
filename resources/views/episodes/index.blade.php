<x-layout title="Episodes">
    <form action="" method="post" action="#">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episodio {{ $episode->number }}
                    <input type="checkbox" name="episodes[]" value="{{$episode->id}}" @if ($episode->watched) checked @endif />
                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
</x-layout>
