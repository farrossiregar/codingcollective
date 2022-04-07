<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use Auth;

class Data extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name, $request_type;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        
        if(check_access('account-payable.fin-spv')){
            // $data = \App\Models\AccountPayable::where('status', '1')->where('request_type', '1')->where('request_type', '2')->where('request_type', '3')->orderBy('created_at', 'desc');
            $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
                            $query->where('request_type', '=', '1')
                                ->orWhere('request_type', '=', '2')
                                ->orWhere('request_type', '=', '3');
                        })->orderBy('created_at', 'desc');
        }elseif(check_access('account-payable.fin-mngr')){
            $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
                            $query->where('request_type', '=', '4')
                                ->orWhere('request_type', '=', '5')
                                ->orWhere('request_type', '=', '6');
                        })->orderBy('created_at', 'desc');
        }elseif(check_access('account-payable.sr-fin-acc-mngr')){
            $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
                            $query->where('request_type', '=', '7')
                                ->orWhere('request_type', '=', '8')
                                ->orWhere('request_type', '=', '9');
                        })->orderBy('created_at', 'desc');
        }elseif(check_access('account-payable.pmg')){
            $data = \App\Models\AccountPayable::orderBy('created_at', 'desc');
        }else{
            $user = Auth::user();
            $data = \App\Models\AccountPayable::where('nik', $user->nik)->orderBy('created_at', 'desc');
        }
        if($this->filteryear) $data->whereYear('created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('created_at',$this->filtermonth);                
        if($this->filterproject) $data->where('project',\App\Models\ClientProject::where('id', $this->filterproject)->first()->name);                        
        if($this->request_type) $data->where('request_type',$this->request_type);                        
        
        return view('livewire.account-payable.data')->with(['data'=>$data->paginate(50)]);   
    }
}