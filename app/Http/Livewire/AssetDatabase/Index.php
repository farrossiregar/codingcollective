<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // if(!check_access('asset-database.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        return view('livewire.asset-database.index');
    }
}