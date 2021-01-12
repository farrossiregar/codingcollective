<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use Livewire\WithPagination;

class Edit extends Component
{
    public $data;
    public $name;
    public $items;
    public $parent_id;
    protected $listeners = ['toggleModal'];
    protected $paginationTheme = 'bootstrap';

    use WithPagination;
    
    public function render()
    {
        return view('livewire.module.edit')->with(['data'=>$this->data]);
    }
    
    public function mount($id)
    {
        $this->data = \App\Models\Module::find($id);
        $this->items = \App\Models\ModulesItem::where('module_id',$id)->whereNull('parent_id')->get();
        $this->name = $this->data->name;
    }
    public function save()
    {
        $this->validate([
            'name'=>'required'
        ]);   
        $this->data->name = $this->name;
        $this->data->save();
        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('module.edit',['id'=>$this->data->id]);
    }
    public function deleteItem($id)
    {
        \App\Models\ModulesItem::find($id)->delete();
        $this->items = $this->items->fresh();
        $this->items = \App\Models\ModulesItem::where('module_id',$this->data->id)->get();
    }

    public function addFunction($id)
    {
        $this->parent_id = $id;
        $this->emit('modalAddFunction',$id);
    }

    public function toggleModal()
    {
        $this->items = $this->items->fresh();
        $this->items = \App\Models\ModulesItem::where('module_id',$this->data->id)->get();
        
        $this->emit('hideModal');
    }
}