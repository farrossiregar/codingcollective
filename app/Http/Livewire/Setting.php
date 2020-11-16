<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Setting extends Component
{
    use WithFileUploads;

    public $logoUrl;
    public $logo;
    public $message;
    public $company;
    public $email;
    public $phone;
    public $website;
    public $address;

    public function render()
    {
        return view('livewire.setting')->with(['title'=>'General']);
    }

    public function mount()
    {
        $this->company = get_setting('company');
        $this->email = get_setting('email');
        $this->phone = get_setting('phone');
        $this->website = get_setting('website');
        $this->address = get_setting('address');
        $this->logoUrl = get_setting('logo');
    }
    public function updateBasic()
    {
        update_setting('company',$this->company);
        update_setting('email',$this->email);
        update_setting('phone',$this->phone);
        update_setting('website',$this->website);
        update_setting('address',$this->address);
    }

    public function save()
    {
        $this->validate([
            'logo' => 'image:max:1024', // 1Mb Max
        ]);
        $name = 'logo.'.$this->logo->extension();
        $this->logo->storePubliclyAs('public',$name);

        update_setting('logo',$name);
    }
}