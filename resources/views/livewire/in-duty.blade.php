<form wire:submit.prevent="submit" method="post" class="main-page-container">
    <p class="page-title">Compose presence</p>
    @foreach ($textFields as $fieldName => $value)
        <label for="{{ $fieldName }}">{{ ucfirst( str_replace('_', ' ', $fieldName) ) }}</label>
        <input
            type="text"
            name="{{ $fieldName }}"
            wire:model="textFields.{{ $fieldName }}"
            wire:keyup="search('{{ $fieldName }}')"
            >
        @if ( !empty($textFields[$fieldName]) )
            
            @if ( !empty($searchResult[$fieldName]) )
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
            <span class="searchResultContainer">no user found</span>
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
