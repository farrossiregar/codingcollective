<?php

namespace App\Http\Livewire\AssetTransferRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Data extends Component
{
    use WithPagination;
    public $project, $date, $filterproject, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // $data = \App\Models\AssetRequest::select('asset_transfer_request.*', 'asset_request.id as id_asset_req', 'asset_request.serial_number', 'asset_request.dana_from', 'asset_request.dana_amount')
        //                                 ->where('asset_request.company_name', Session::get('company_id'))
        //                                 ->where('asset_request.status', '1')
        //                                 ->leftjoin('asset_transfer_request', 'asset_request.id', '=', 'asset_transfer_request.id_asset_request')
        //                                 ->orderBy('asset_request.created_at', 'desc');
            
        $data = \App\Models\AssetTransferRequest::orderBy('id', 'desc');
        
        return view('livewire.asset-transfer-request.data')->with(['data'=>$data->paginate(50)]);   
    }
}