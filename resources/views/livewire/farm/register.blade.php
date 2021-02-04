@section('title', 'Register a new Farm')
<div>
    <div>Farm</div>
    <form wire:submit.prevent="create">
    <input wire:model="title" type="text">

    <button>Create Post</button>
</form>
</div>
