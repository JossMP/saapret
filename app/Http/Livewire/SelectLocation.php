<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use Livewire\Component;

class SelectLocation extends Component
{
    public $_department_id = null;
    public $_province_id   = null;
    public $_district_id   = null;

    public $department_id = null;
    public $province_id   = null;
    public $district_id   = null;
    public $name = 'home';

    public $departments = null;
    public $provinces   = null;
    public $districts   = null;

    public function mount($department_id = null, $province_id = null, $district_id = null, $name = 'home')
    {
        $this->department_id  = $department_id;
        $this->_department_id = $this->department_id;

        $this->province_id    = $province_id;
        $this->_province_id   = $this->province_id;

        $this->district_id    = $district_id;
        $this->_district_id   = $this->district_id;

        $this->name           = $name;


        if ($this->district_id != null) {
            $district = District::where('id', $this->district_id)->first();
            if ($district) {
                $this->province_id = $district->province_id;
                $this->_province_id   = $this->province_id;
                $province = $district->province;
                if ($province) {
                    $this->department_id = $province->department_id;
                    $this->_department_id = $this->department_id;
                }
            }
        }
    }

    public function render()
    {
        $this->departments = Department::get();
        $this->provinces   = Province::where('department_id', $this->department_id)->get();
        $this->districts   = District::where('province_id', $this->province_id)->get();

        return view('livewire.select-location');
    }

    public function updated()
    {
        if ($this->_department_id != $this->department_id) {
            $this->province_id    = null;
            $this->_province_id   = null;

            $this->district_id    = null;
            $this->_district_id   = null;

            $this->_department_id = $this->department_id;
        }

        if ($this->_province_id != $this->province_id) {
            $this->district_id  = null;
            $this->_district_id = null;

            $this->_province_id = $this->province_id;
        }
        /*
        if ($this->_district_id != $this->district_id) {
            $this->district_id  = $this->_district_id = null;
        }*/
    }
}
