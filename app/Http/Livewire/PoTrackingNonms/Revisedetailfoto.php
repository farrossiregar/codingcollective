<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Revisedetailfoto extends Component
{
    protected $listeners = [
        'modalrevisedetailfoto'=>'revisedetailfoto',
    ];

    use WithFileUploads;
    public $selected_id;
    public $note;

    public function render()
    {

        return view('livewire.po-tracking-nonms.revisedetailfoto');
    }

    public function revisedetailfoto($id)
    {
        $this->selected_id = $id;
        
    }

    public function save()
    {
        
        $user = \Auth::user();

        $data = \App\Models\PoTrackingNonms::where('id', $this->selected_id)->first();

        $data->status_fielddata = 0;
        $data->note_status_fielddata = $this->note;
        $data->save();
        // dd($this->note);

      

        // $notif_user_e2e = check_access_data('po-tracking-nonms.notif-e2e', '');
        
        // $nameusere2e = [];
        // $emailusere2e = [];
        // $phoneusere2e = [];
        // foreach($notif_user_e2e as $no => $itemusere2e){
        //     $nameusere2e[$no] = $itemusere2e->name;
        //     $emailusere2e[$no] = $itemusere2e->email;
        //     $phoneusere2e[$no] = $itemusere2e->telepon;

        //     $message = "*Dear User E2E - ".$nameusere2e[$no]."*\n\n";
        //     $message .= "*PO Tracking Non MS ".$typedoc." pada ".date('d M Y H:i:s')."*\n\n";
        //     send_wa(['phone'=> $phoneusere2e[$no],'message'=>$message]);    

        //     // \Mail::to($emailusere2e[$no])->send(new PoTrackingReimbursementUpload($item));
        // }

        session()->flash('message-success',"Success!, Photo by Field Team is Declined");
        return redirect()->route('po-tracking-nonms.index');
        
    }
}
