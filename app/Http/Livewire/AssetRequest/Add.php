<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Add extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname, $stock;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $reference_pic;

    public function render()
    {

        // $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        // $this->employee_name        = $user->name;
        // $this->position             = get_position($user->user_access_id);
        // $this->location             = '';
        // $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
        //                         ->where('company_id', Session::get('company_id'))
        //                         ->where('is_project', '1')
        //                         ->get();

        

        // $get_project = \App\Models\ClientProject::where('id', \App\Models\EmployeeProject::where('employee_id', Auth::user()->id)->first()->client_project_id)->first();
        // $this->project = $get_project->name;

        // $this->region = \App\Models\Region::where('id', $get_project->region_id)->first()->region_code;

        // $this->datalocation = \App\Models\DophomebaseMaster::where('status', '1')->where('project', $get_project->name)->where('region', $this->region)->orderBy('id', 'desc')->get();

        // if($this->asset_type){
        //     $this->dataassetname = \App\Models\AssetDatabase::where('asset_type', $this->asset_type)->get();
        // }else{
        //     $this->dataassetname = [];
        // }

        // if($this->asset_name){
        //     $getasset = \App\Models\AssetDatabase::where('asset_name', $this->asset_name)->first();
        //     $this->location             = @\App\Models\DophomebaseMaster::where('id', $getasset->location)->first()->nama_dop;
        //     $this->dimension            = @$getasset->dimension;
        //     $this->detail               = $getasset->detail;
        //     $this->stock                = (int)$getasset->stok;
        //     $this->reference_pic        = $getasset->reference_pic;
            
        // }else{
        //     $this->location             = '';
        //     $this->dimension            = '';
        //     $this->detail               = '';
        //     $this->Stock                = 0;
        //     $this->reference_pic        = '';
        // }

        return view('livewire.asset-request.add');
    }

  
    public function save()
    {

        // $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = new \App\Models\AssetDatabase();
        $data->company_id               = Session::get('company_id');
        $data->project                  = $this->project;      
        $data->region                   = $this->region;
        // $data->name                     = $this->employee_name;
        // $data->nik                      = $user->nik;
        $data->asset_type               = $this->asset_type;
        $data->asset_name               = $this->asset_name;
        $data->location                 = $this->location;
        $data->dimension                = $this->dimension;
        $data->detail                   = $this->detail;
        $data->reason_request           = $this->reason_request;
        $data->source_asset             = 'request';
        $this->validate([
            'file'=>'required|mimes:jpg,jpeg,png|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $reference_request = 'reference-request'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Asset_request/',$reference_request);

            $data->reference_pic         = $reference_request;
        }
        $data->link                     = $this->link;
        
        $data->save();

        // $notif = get_user_from_access('asset-request.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Asset Request Berhasil diinput");
        
        return redirect()->route('asset-request.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



