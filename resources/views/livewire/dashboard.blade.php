@section('title', 'Home')
@section('header', 'Home')
<div>
    <div>
        <a href="{{route('rabbits.create')}}" class="underline font-bold leading-6 text-md uppercase">Add rabbits to the farm</a>
        @if($rabbits)
        <div class="my-8">
            <div class="uppercase text-sm font-bold">Served Rabbits</div>
            @forelse($rabbits as $rabbit)
                <div class="w-full flex justify-between bg-white border border-gray-200 py-4 px-2 my-2">
                    <div>
                        <div>{{$rabbit->mother->rabbit_no}}</div>
                        <div>
                            Gestation Period: {{$rabbit->gestation_period}} days
                        </div>
                    </div>
                    <div class="pr-4">
                        <div>
                            <a href="" class="underline font-bold leading-6 text-md uppercase">Register a birth</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        @endif
    </div>
</div>
