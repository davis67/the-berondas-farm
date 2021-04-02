@section('title', 'Batches')
@section('header', 'Batches')
<div class="mt-2">
    <div class="block">
      <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
        <div class="flex flex-col mt-2">
          <div class="py-4">
              <a href="{{route('batches.create')}}" class="underline font-bold leading-6 text-md uppercase">Add a New Batch</a>
          </div>
           <div class="grid @if($batches)grid-cols-3 @else grid-cols-1 @endif gap-4">
            @forelse($batches as $batch)
            <div class="border border-1 pl-3 flex items-center bg-white shadow-sm h-32 my-2 overflow-hidden rounded-none">
              <a href="{{route('batches.show', $batch->id)}}" class="w-full">
                <div class="flex w-full items-center">
                  <div class="space-y-2">
                    <div><span>{{$batch->batch_no}}</span></div>
                    <div><span>{{$batch->number_of_cages}} Doors</span></div>
                    <div><span>{{$batch->expected_number_of_rabbits}} Exp Rabbits</span></div>
                  </div>

                </div>
              </a>
            </div>
            @empty
            <div class="bg-white border border-gray-200 w-full py-4 px-2 items-center">
                <div class="font-medium text-gray-400 text-xl">No batches found...</div>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
</div>
