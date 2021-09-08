<form wire:submit.prevent="submit" method="post" class="main-page-container">
    {{ json_encode($formation) }}
    @foreach ($textFields as $fieldName => $value)
        <label for="{{ $fieldName }}">{{ ucfirst( str_replace('_', ' ', $fieldName) ) }}</label>
        <input
            type="text"
            name="{{ $fieldName }}"
            wire:model="textFields.{{ $fieldName }}"
            wire:keyup="search('{{ $fieldName }}')"
            >
            
            @if ( $searchResult[$fieldName] )
                <div class="searchResultContainer">
                    @foreach ($searchResult[$fieldName] as $item)
                        <div
                            class="searchResult"
                            wire:click="select('{{ $fieldName }}', '{{ $item }}')"
                        >
                            {{ $item}}
                        </div>
                    @endforeach
                </div>
            @endif
            
            <div class="selection-container">
                @foreach ($formation[$fieldName] as $selection)
                    <span class="selection">
                        {{ $selection }}
                        <button
                            class="remove-selection"
                            wire:click.prevent="remove('{{ $fieldName }}', '{{ $selection }}')">&times;</button>
                    </span>
                @endforeach
            </div>
        @endforeach
</form>
