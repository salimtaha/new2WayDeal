<?php

namespace App\Http\Livewire\Charity\Register;

use App\Models\City;
use App\Models\Governorate;
use Livewire\Component;

class RegisterSelect extends Component
{

    public  $selectedGovernorate = null;
     public $cities =null;
     public $selectedCity = null;

    public function render()
    {

        $governorates = Governorate::all();

        return view('livewire.charity.register.register-select' , compact('governorates' ));
    }
    public function updatedSelectedGovernorate($governorate_id)
    {
          $this->cities = City::where('governorate_id' , $governorate_id)->get();
    }

}
