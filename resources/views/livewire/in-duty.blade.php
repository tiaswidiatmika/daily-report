<form wire:submit.prevent="submit" method="post" class="main-page-container">
    {{ json_encode($formation) }}
    <p class="page-title">Compose presence</p>
    @foreach ($textFields as $fieldId => $value)
        @php
            $fieldName = \App\Models\Position::find($fieldId)->name;
        @endphp
        <strong><label for="{{ $fieldName }}">{{ ucfirst( str_replace('_', ' ', $fieldName) ) }}</label></strong>
        <input
            type="text"
            autocomplete="off"
            name="{{ $fieldId }}"
            wire:model="textFields.{{ $fieldId }}"
            wire:keyup="search('{{ $fieldId }}')"
            >
        @if ( !empty($textFields[$fieldId]) )
            
            @if ( !empty($searchResult[$fieldId]) )
                <div class="searchResultContainer">
                    @foreach ($searchResult[$fieldId] as $item)
                        <div
                            class="searchResult"
                            wire:click="select('{{ $fieldId }}', '{{ $item }}')"
                        >
                            {{ $item}}
                        </div>
                    @endforeach
                </div>
            @endif
            <span class="searchResultContainer">no user found</span>
        @endif    
            <div class="selection-container">
                @foreach ($formation[$fieldId] as $alias)
                    <span class="selection">
                        {{ $alias }}
                        <button
                            class="remove-selection"
                            wire:click.prevent="remove('{{ $fieldId }}', '{{ $alias}}')">&times;</button>
                    </span>
                @endforeach
            </div>
        @endforeach
    <button type="submit">submit</button>
</form>
