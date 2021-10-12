<div>
    <button wire:click="open">create</button>

    @if ($show)
        <div wire:click="dismiss" style="position: fixed; display: flex; top: 0; left: 0; right: 0; bottom: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8)">
            <div wire:click.stop
                style="margin: auto; padding: 20px 24px; border-radius: 8px; background-color: #fff !important; overflow: hidden; width: 100%; max-width: 480px; height: 180px; position: relative;">
                <h3 style="margin: 0;">create</h3>
                <div>
                    <label for="name">
                        Shift name
                        <input type="text" id="name" wire:model="shift.name">
                    </label>
                </div>

                <div>
                    <label for="range">
                        Shift range
                        <input type="text" id="range" wire:model="shift.range">
                    </label>
                </div>
                <button wire:click="dismiss">cancel</button>
                <button wire:click="submit">save</button>
            </div>
        </div>
    @endif
</div>
