<div>
    @foreach ($shifts as $shift)
        <div>
            {{ $shift->name }} <br> {{ $shift->range }}
            <livewire:shift.edit :shift="$shift"/>
            <livewire:shift.delete :shift="$shift"/>
            <hr>
        </div>

        {{-- <livewire:shift.delete :shift="$shift"/> --}}
        @endforeach
        
</div>
