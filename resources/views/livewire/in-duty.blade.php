<form wire:submit.prevent="submit" method="post" class="main-page-container">
    @if ($lastFormation !== null)
        <span>
            <input type="checkbox" name="previous" id="previous" wire:click="setPrevious">
            <label for="previous">same as previous</label>
        </span>
    @endif
    <div>
        @include('livewire.konter-foreigner')
        @include('livewire.konter-indonesia')
        @include('livewire.konter-diplounderabtc')
        @include('livewire.cuti')
        @include('livewire.sakit')
        @include('livewire.izin')
        @include('livewire.protokoler')
    </div>
    <button class="p-2 bg-blue-600 text-white" type="submit">submit</button>
</form>
