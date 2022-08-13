<?php

namespace App\Http\Livewire\Finance\SupplierVendor;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\SupplierVendorType as ModelSupplierVendorType;

class SupplierVendorType extends Component
{
    protected $listeners = ['reload'=>'$refresh'];
    public $insert=false,$name;
    public function render()
    {
        $data = ModelSupplierVendorType::where('company_id',session()->get('company_id'))->orderBy('id','DESC');

        return view('livewire.finance.suppliervendor.suppliervendor-type')->with(['data'=>$data->get()]);
    }
    

    public function save()
    {
        $this->validate([
            'name' => ['required',
                Rule::unique('suppliervendor_type')->where(function ($query) {
                    return $query->where('company_id',session()->get('company_id'))->where('name', $this->name);
                })
            ],
        ],
        [
            'name.unique' => 'Data already exists'
        ]);

        $data = new ModelSupplierVendorType();
        $data->company_id = session()->get('company_id');
        $data->name = $this->name;
        $data->save();

        $this->insert = false;
        $this->reset(['name']);
        $this->emit('reload');
    }
}