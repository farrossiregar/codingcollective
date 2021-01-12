<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;

class Form extends Component
{
    public $item_name;
    public $item_link;
    public $type;
    public $data;
    public $icon,$valid_link=0;
    public function render()
    {
        return view('livewire.module.form');
    }

    public function mount($data)
    {
        $this->data = $data;
    }

    public function saveItems()
    {
        $valid = [
            'item_name'=>'required',
            'item_link'=>'required',
            'type'=>'required'
        ];
        $valid_msg = [];
        if($this->type=='1'){ 
            if(\Route::has($this->item_link)) $this->valid_link = 1;
            
            $valid['valid_link'] = 'accepted:1';
            $valid_msg['valid_link.accepted'] = 'Routing tidak valid';
        }
        $this->validate($valid,$valid_msg);

        $data = new \App\Models\ModulesItem();
        $data->module_id = $this->data->id;
        $data->name = $this->item_name;
        $data->link = $this->item_link;
        $data->type = 1;
        $data->icon = $this->icon;
        $data->status = 1;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));
        
        $this->emitTo('module.edit','toggleModal');
        $this->reset('item_name','item_link','type','icon');
    }
}