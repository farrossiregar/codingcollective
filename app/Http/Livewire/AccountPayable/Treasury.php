<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use DB;

class Treasury extends Component
{
    protected $listeners = [
        'modaltreasuryaccountpayable'=>'modaltreasuryaccountpayable',
    ];

    use WithFileUploads;
    public $selected_id, $bank_account_name, $bank_account_number, $bank_name;    

    
    public function render()
    {
        return view('livewire.account-payable.treasury');
    }

    public function modaltreasuryaccountpayable($id)
    {
        $this->selected_id = $id;

        $data                           = \App\Models\AccountPayable::where('id', $this->selected_id)->first();
        $this->bank_account_name        = $data->bank_account_name;
        $this->bank_account_number      = $data->bank_account_number;
        $this->bank_name                = $data->bank_name;
    }

  
    public function save()
    {
        // $type_approve       = $this->selected_id;

        
        $data                           = \App\Models\AccountPayable::where('id', $this->selected_id)->first();
        $data->bank_account_name        = $this->bank_account_name;
        $data->bank_account_number      = $this->bank_account_number;
        $data->bank_name                = $this->bank_name;
        
        $data->save();

        // $datahistory = new \App\Models\LogActivity();
        // $datahistory->subject = 'Approvalhistoryaccountpayable'.$type_approve[0];
        // $datahistory->var = '{"status":"'.$data->status.'","note":"'.$this->note.'"}';
        // $datahistory->save();

    
        // $notif = get_user_from_access('account-payable.toc-leader');
        
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule is Approve </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }



        session()->flash('message-success',"Berhasil, Request Account Payable sudah diapprove!!!");
        
        return redirect()->route('account-payable.index');
    }
}
