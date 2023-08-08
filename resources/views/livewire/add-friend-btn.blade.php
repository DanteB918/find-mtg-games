<div>
    <div class="alert-cont">
        @if (session()->has('message'))
        
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <button class="btn btn-primary" wire:click="addFriend"><i class="fa-solid fa-user-plus"></i>{{ $content }}</button>
</div>
