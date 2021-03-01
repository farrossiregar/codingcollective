<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Importesar extends Component
{
    protected $listeners = [
        'modal-esar'=>'dataesar',
    ];

    use WithFileUploads;
    public $file;
    public $app_esar, $appesar, $selected_id, $approvedesar;
    public function render()
    {
        return view('livewire.po-tracking.importesar');
    }

    public function dataesar($id)
    {
        $this->selected_id = $id;
        $this->data = \App\Models\PoTrackingReimbursementMaster::where('id', $this->selected_id)->first();
        $this->approvedesar = $this->data->approved_esar_date_upload;
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:pdf|max:51200' // 50MB maksimal
        ]);


        if($this->file){
            $esar = 'autogenerated_esar'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/po_tracking/esar/',$esar);

            $data = \App\Models\PoTrackingReimbursementMaster::where('id', $this->selected_id)->first();
            $data->approved_esar_date_upload = date('Y-m-d H:i:s');
            $data->save();
        }

        session()->flash('message-success',"Upload Approved ESAR success");

        return redirect()->route('po-tracking.index');
    }
}
