@section('title', 'Home')
@section('header', 'Home')
<div>
    <div>
        <div>
            <span class="font-bold leading-6 text-md uppercase">N0 of Rabbits: {{ $total_rabbits }}</span>
        </div>
        <div>
            <span class="font-bold leading-6 text-md uppercase">Female Rabbits: {{ $total_female }}</span>
        </div>
        <div>
            <span class="font-bold leading-6 text-md uppercase">Male Rabbits: {{ $total_male }}</span>
        </div>
        <div>
            <span class="font-bold leading-6 text-md uppercase">Kits: {{ $total_kits }}</span>
        </div>
        <div>
            <span class="font-bold leading-6 text-md uppercase">Pregnant Rabbits: {{ $rabbits->count() }}</span>
        </div>
    </div>
    <div>
        <a href="{{route('rabbits.create')}}" class="underline font-bold leading-6 text-md uppercase">Add rabbits to the farm</a>
    </div>
    <div class="my-4">
        <a href="{{route('breed-types.index')}}" class="underline font-bold leading-6 text-md uppercase">View all Breed Types</a>
    </div>
    <div class="my-8">
        <div class="uppercase text-sm font-bold">Served Rabbits</div>
        @forelse($rabbits as $rabbit)
        <div class="w-full flex-shrink-0 flex-col lg:flex lg:justify-between bg-white border border-gray-200 py-4 px-2 my-2">
            <div>
                <div>{{$rabbit->mother->rabbit_no}} @if($rabbit->mother->current_cage)<span class="font-bold text-teal-700">({{ $rabbit->mother->current_cage->cage_no}})</span>@endif</div>
                <div>
                    Gestation Period: {{$rabbit->gestation_period}} days
                </div>
                <div>
                    Date of Servicing: {{$rabbit->date_of_servicing}}
                </div>
                <div>
                    Expected Date of Birth: {{$rabbit->expected_date_of_birth}}
                </div>
            </div>
            <div class="pr-4">
                <div>
                    <a href="{{route('rabbits.register-birth', $rabbit->id)}}" class="underline font-bold leading-6 text-md uppercase">Register a birth</a>
                </div>
            </div>
        </div>
        @empty
        <div class="w-full flex justify-between bg-white border border-gray-200 py-4 px-2 my-2">
            <div>
                No Served Rabbits at the moment...
            </div>
        </div>
        @endforelse
    </div>
</div>
