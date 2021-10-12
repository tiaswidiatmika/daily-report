<span wire:keydown.enter="submit">
    <button wire:click="open">edit</button>

    @if ($show)
        <div wire:click="dismiss" style="position: fixed; display: flex; top: 0; left: 0; right: 0; bottom: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.8)">
            <div wire:click.stop
                style="margin: auto; padding: 20px 24px; border-radius: 8px; background-color: #fff !important; overflow: hidden; width: 100%; max-width: 480px; height: 180px; position: relative;">
                {{-- <h3 style="margin: 0;">{{ $shift->name }}</h3> --}}
                <form
                    wire:submit.prevent="submit"
                    method="post"
                    wire:keydown.escape="dismiss"
                >
                    <label for="">SHIFT NAME</label><br>
                    <input type="text" name="name" id="" wire:model.debounce.500ms="shift.name" value="{{ $shift->name }}"><br>
                    @error('shift.name')
                        {{ $message }} <br>
                    @enderror
                    <label for="">TIME RANGE</label><br>
                    <input type="text" name="range" id="" wire:model="shift.range" value="{{ $shift->range }}"><br>
                    @error('shift.range')
                        {{ $message }} <br>
                    @enderror
                    <button wire:click.prevent="dismiss">cancel</button>
                    <button type="submit">save</button>
                </form>
            </div>
        </div>
    @endif
</span>
