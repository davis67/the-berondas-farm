@section('title', 'Home')
@section('header', 'Home')
<div>
    <span>Dashboard</span>
    <div>
        <a href="{{route('rabbits.create')}}">Add rabbits to the farm</a>

        <div>
            <div>Pregnant Rabbits</div>
            @forelse($rabbits as $rabbit)
                <div>{{$rabbit->mother->rabbit_no}}</div>
            @empty
            @endforelse
        </div>
    </div>
</div>
