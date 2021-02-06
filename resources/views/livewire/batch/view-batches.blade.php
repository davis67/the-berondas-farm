@section('title', 'Batches')
<div class="mt-2">
    <div class="block">
      <div class="mx-auto text-lg leading-6 font-medium text-cool-gray-900">
        <div class="flex flex-col mt-2">
           <div class="grid grid-cols-3 gap-4 border border-1">
            @forelse($batches as $batch)
            <div class="border border-1 bg-white shadow-sm h-32 my-2 overflow-hidden rounded-none">
              <a href="" class="w-full">
                {{$batch->batch_no}}
              </a>
            </div>
            @empty
            <div class="flex justify-center items-center space-x-2">
                <svg class="-ml-1 mr-2 h-8 w-8 text-cool-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884zM18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium py-8 text-cool-gray-400 text-xl">No batches found...</span>
            </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
</div>
