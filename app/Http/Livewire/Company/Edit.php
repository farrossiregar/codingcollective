<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use App\Models\Company;
use App\Helpers\GeneralHelper;

class Edit extends Component
{
    public $data;
    public $name;
    public $telepon;
    public $address;
    public $logo;
    public $code;
    public $website;
    public $message;

    protected $rules = [
        'name' => 'required|string',
        'telepon' => 'required|string',
        'address' => 'required|string',
        'logo' => 'required|string',
        'code' => 'required|string',
        'website' => 'required|string',
    ];

    public function render()
    {
        if(check_access_controller('company.edit') == false){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }
        return view('livewire.company.edit')->with(['data'=>$this->data]);
    }

    public function mount($id)
    {
        $this->data = Company::find($id);
        
        $this->name = $this->data->name;
        $this->telepon = $this->data->telepon;
        $this->address = $this->data->address;
        $this->logo = $this->data->logo;
        $this->code = $this->data->code;
        $this->website = $this->data->website;
        
    }

    public function save(){
        $this->validate();
        
        $this->data->name = $this->name;
        $this->data->telepon = $this->telepon;
        $this->data->address = $this->address;
        $this->data->logo = $this->logo;
        $this->data->code = $this->code;
        $this->data->website = $this->website;
        $this->data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->to('company');
    }
}
