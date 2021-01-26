<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use App\Models\SiteListTrackingMaster;
use App\Models\SiteListTrackingDetail;


class Edit extends Component
{
    public $data;
    // public $id;
    public $collection;
    public $item_number;
    public $date_po_released;
    public $pic_rpm;
    public $pic_sm;
    public $type;
    public $message;


    public function render()
    {
        // if(check_access_controller('cluster.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
        // dd(json_decode($this->id));
        return view('livewire.sitetracking.edit')->with(['data'=>$this->data]);
    }

    public function mount($id)
    {
        $this->data                     = SiteListTrackingDetail::where('id_site_master',$id)->get();
        
    }

    // public function save(){
    //     $this->validate();
        
    //     $this->data->name = $this->name;
    //     $this->data->region_id = $this->region_id;
    //     $this->data->save();

    //     session()->flash('message-success',__('Data saved successfully'));

    //     return redirect()->to('cluster');
    // }
}
