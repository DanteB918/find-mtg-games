<div>
        @if (session()->has('message'))
            <div class="alert-cont">
                <div class="alert alert-success" wire:click="deleteFlash">
                    {{ session('message') }} <i class="fa-solid fa-user-check"></i>
                </div>
            </div>
        @endif

    <button class="btn btn-primary" wire:click="addFriend"><i class="fa-solid fa-user-plus"></i> {{ $content }}</button>
</div>
