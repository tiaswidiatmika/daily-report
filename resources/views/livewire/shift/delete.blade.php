<span>
    <button wire:click="open">delete</button>

    @if ($show)
        <div wire:click="dismiss" style="position: fixed; display: flex; top: 0; left: 0; right: 0; bottom: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8)">
            <div wire:click.stop
                style="margin: auto; padding: 20px 24px; border-radius: 8px; background-color: #fff !important; overflow: hidden; width: 100%; max-width: 480px; height: 180px; position: relative;">
                {{-- <h3 style="margin: 0;">{{ $shift->name }}</h3> --}}
                Are you sure want to delete {{ $shift->name }}?
                <button wire:click="delete">yes</button>
                <button wire:click="dismiss">no</button>
            </div>
        </div>
    @endif
</span>
