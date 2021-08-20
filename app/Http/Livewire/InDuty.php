<?php

namespace App\Http\Livewire;

use App\Models\{User, Formation};
use Livewire\Component;

class InDuty extends Component
{
    public $allowDuplicateSearches = false;

    // * properties used for search input "Konter Foreigner"
    public $searchKonterForeigner = '';
    public $usersKonterForeigner = [];
    public $usersExcluded = [];

    // * properties  for search input "Konter Indonesia"
    public $searchKonterIndonesia = '';
    public $usersKonterIndonesia = [];

    // * properties  for search input "Konter diplo under abtc"
    public $searchKonterDiplounderabtc = '';
    public $usersKonterDiplounderabtc = [];

    // * properties  for search input "Konter Indonesia"
    public $searchCuti = '';
    public $usersCuti = [];

    // * properties used for search input "Sakit"
    public $searchSakit = '';
    public $usersSakit = [];

    // * properties used for search input "Sakit"
    public $searchIzin = '';
    public $usersIzin = [];
    
    // * protokoler
    public $searchProtokoler = '';
    public $usersProtokoler = [];

    // * users retrieved without searching
    public $usersHonorer;
    public $usersKaunit;
    public $usersSpv;
    public $usersOpis;
    // * $users is a variable to display list of user while typing on live search
    public $users;

    public $usePrevious = true;
    public $lastFormation;
    public function mount()
    {
        $this->users = [];
        // $this->usersExcluded = [];
        $this->usersHonorer = User::ofRole( 'honorer' )->pluck('name');
        $this->usersSpv = User::ofRole( 'spv' )->pluck('name');
        $this->usersOpis = User::ofRole( 'opis' )->pluck('name');
        $this->usersKaunit = User::ofRole( 'kaunit' )->pluck('name');
        $this->lastFormation = Formation::orderBy('created_at', 'DESC')->first();
    }

    public function render()
    {
        return view('livewire.in-duty');
    }

    public function submit()
    {
        $formation = Formation::create([
            'date' => todayIs()->date,
            'foreigner' => json_encode($this->usersKonterForeigner),
            'diplomatik' => json_encode($this->usersKonterDiplounderabtc),
            'cuti' => json_encode( $this->usersCuti ),
            'izin' => json_encode( $this->usersIzin ),
            'sakit' => json_encode( $this->usersSakit ),
            'paspor_indonesia' => json_encode($this->usersKonterIndonesia),
            'honorer' => json_encode($this->usersHonorer),
            'protokoler' => json_encode($this->usersProtokoler),
            'spv' => json_encode($this->usersSpv),
            'opis' => json_encode($this->usersOpis),
            'kaunit' => json_encode($this->usersKaunit),
        ]);

    }
    public function setPrevious ()
    {
        if ( $this->usePrevious ) {
            $formation = $this->lastFormation;
            $this->usersKonterIndonesia = json_decode($formation->honorer) ?? [];
            $this->usersKonterForeigner = json_decode($formation->foreigner) ?? [];
            $this->usersKonterDiplounderabtc = json_decode($formation->diplomatik) ?? [];
            $this->usersCuti = json_decode($formation->cuti) ?? [];
            $this->usersSakit = json_decode($formation->sakit);
            $this->usersIzin = json_decode($formation->izin);
            $this->usersProtokoler = json_decode($formation->protokoler) ?? [];
            $collection = [
                ...$this->usersKonterIndonesia,
                ...$this->usersKonterForeigner,
                ...$this->usersKonterDiplounderabtc,
                ...$this->usersCuti,
                ...$this->usersSakit,
                ...$this->usersIzin,
                ...$this->usersProtokoler
            ];
            $this->usersExcluded = array_merge($this->usersExcluded, $collection);
            $this->usePrevious = !$this->usePrevious;
        } else {
            $this->usersKonterIndonesia = [];
            $this->usersKonterForeigner = [];
            $this->usersKonterDiplounderabtc = [];
            $this->usersCuti = [];
            $this->usersSakit = [];
            $this->usersIzin = [];
            $this->usersProtokoler = [];
            $this->usersHonorer = [];
            $this->usersExcluded = [];
            $this->usePrevious = !$this->usePrevious;
        }
    }

    public function search($wireModel)
    {   
        if (empty($this->{$wireModel})) {
            $this->users = [];
            return;
        }
        $builder = User::ofRole('staff')->where('alias', 'like', "%{$this->$wireModel}%");
        if ($this->allowDuplicateSearches) {
            $this->users = $builder
                ->take(10)
                ->get()
                ->pluck('alias')
                ->toArray();
        } else {
            $this->users = $builder
                ->whereNotIn('alias', $this->usersExcluded)
                ->take(10)
                ->get()
                ->pluck('alias')
                ->toArray();
        }
    }
    public function clickResult($result, $wireModel, $userCollectionType)
    {
        
        $this->$wireModel = $result; // manipulate component a wire model
        
        array_push($this->$userCollectionType, $result); // some business logic
        $this->$wireModel = ''; //resetting input inner text
        
        array_push($this->usersExcluded, $result);
        $this->users = []; // resetting </li> users
    }

    public function removeSelectedUser($needle, $hayStack)
    {
        $this->$hayStack = array_diff($this->$hayStack, [$needle] );
        $this->usersExcluded = array_diff($this->usersExcluded, [$needle]);
    }
    public function putLastFormationToExcluded ($collection)
    {
        array_push($this->usersExcluded, $collection);
    }

    public function showarray()
    {
        $this->array = json_encode($this->usersAvailable);
        $this->keys = json_encode(array_keys($this->usersAvailable));
    }

    public function transformToFullName ( $array ) 
    {
        foreach ($array as $key => $value) {
            foreach ($value as $index => $item) {
                $array[$key][$index] = $this->fullName( $item );
            }
        }
        return $array;
    }

    public function fullName(String $name)
    {   
        return User::where('alias', $name)
            ->first()
            ->name;
    }
}