<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // if(!check_access('account-payable.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        // echo \Auth::user()->user_access_id; die();
        return view('livewire.account-payable.index');
    }
}
