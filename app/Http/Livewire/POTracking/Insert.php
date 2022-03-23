<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\UserEpl;
use App\Models\PoTrackingReimbursementMaster;
use App\Mail\PoTrackingReimbursementUpload;
use App\Models\PoTrackingReimbursementAccdocupload;
use App\Models\PoTrackingReimbursementEsarupload;
use App\Models\PoTrackingReimbursementBastupload;
use PDF;
use DB;

class Insert extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.po-tracking.insert');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        $datamaster = new PoTrackingReimbursementMaster();
        $datamaster->save();

        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $datapo = new PoTrackingReimbursement();
                if($i[1]=="") continue;
                // dd($i);
                $datapo->po_no = $i[1];
                if($i[2]) $datapo->po_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[2])->format('Y-m-d');
                $datapo->po_status = $i[3];
                if($i[4]) $datapo->period = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[4])->format('Y-m-d');
                $datapo->region = $i[5];
                $datapo->branch = $i[6];
                $datapo->boq = $i[7];
                $datapo->bast_number = $i[8];
                $datapo->gr_no = $i[9];
                if($i[10]) $datapo->gr_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[10])->format('Y-m-d');
                $datapo->invoice_no = $i[11];
                if($i[12]) $datapo->invoice_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[12])->format('Y-m-d');
                $datapo->actual_amount = $i[13];
                $datapo->amunt_to_be_claim = $i[14];
                if($i[15]) $datapo->date_of_payment = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[15])->format('Y-m-d');
                $datapo->employee_id = \Auth::user()->employee->id;
                $datapo->id_po_tracking_master                   = $datamaster->id;
                $datapo->save();
                $total_success++;
            }

            $pono = [];
            $data_podetail = [];
            foreach(PoTrackingReimbursement::select('po_no')->where('id_po_tracking_master', $datamaster->id)->groupBy('po_no')->get() as $key => $item){
                $pono[$key] = $item->po_no;
                $data_podetail = PoTrackingReimbursement::
                                                            where('id_po_tracking_master', $datamaster->id)
                                                            ->first();

                $pdf = \App::make('dompdf.wrapper');
                // $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$data_podetail,'potracking_master'=>$data_podetailmaster]);
                $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$data_podetail]);
                $pdf->stream();

                $output = $pdf->output();
                $filename = 'po-reimbursement'.$pono[$key];
                
                $destinationPath = public_path('\storage\po_tracking\AutoGeneratedEsar'.$filename);
                \Storage::put($destinationPath .'.pdf',$output);

                $insertesarupload                               = new PoTrackingReimbursementEsarupload();
                $insertesarupload->id_po_tracking_master        = $datamaster->id;
                $insertesarupload->po_no                        = $pono[$key];
                $insertesarupload->autogenerated_esar_filename  = $filename.'.pdf';
                $insertesarupload->po_tracking_reimbursement_id  = $data_podetail->id;
                $insertesarupload->save();

                $insertbastupload                               = new PoTrackingReimbursementBastupload();
                $insertbastupload->id_po_tracking_master        = $datamaster->id;
                $insertbastupload->po_no                        = $pono[$key];
                $insertbastupload->region                       = "";
                $insertbastupload->bast_filename                = "";
                $insertbastupload->bast_uploader_userid         = "";
                $insertbastupload->bast_date                    = "";
                $insertbastupload->po_tracking_reimbursement_id = $data_podetail->id;
                $insertbastupload->save();

                $insertaccdocupload                               = new PoTrackingReimbursementAccdocupload();
                $insertaccdocupload->id_po_tracking_master        = $datamaster->id;
                $insertaccdocupload->po_no                        = $pono[$key];
                $insertaccdocupload->po_tracking_reimbursement_id  = $data_podetail->id;
                $insertaccdocupload->save();
            }

            $regional = [];
            $regional_code = [];
            // $dataparam = 'Test PO Reimbursement';  
            //$dbpmt = 'pmt';      
            $dbpmt = env('DB_DATABASE');      
            //$dbepl = 'epl';      
            $dbepl = env('DB_DATABASE_EPL_PMT');      
            $potrackingarea = DB::table($dbpmt.'.po_tracking_reimbursement as po_tracking_reimbursement')
                                    ->join($dbepl.'.region as region', 'region.region_code', '=', 'po_tracking_reimbursement.bidding_area'); 
            $potrackingareaget = $potrackingarea->select('region.id', 'region.region_code','po_tracking_reimbursement.project_code','po_tracking_reimbursement.project_name')
                                                    ->where('po_tracking_reimbursement.id_po_tracking_master', $datamaster->id)
                                                    ->groupBy('po_tracking_reimbursement.bidding_area')
                                                    ->get();

            // $potrackingareaget = PoTrackingReimbursement::where('id_po_tracking_master',$datamaster->id)->groupBy('bidding_area')->get();

            foreach($potrackingareaget as $key => $item){
                $regional[$key] = $item->id;
                $regional_code[$key] = $item->region_code;
                // $regional_code[$key] = $item->region->region_code;
                // $regional[$key] = $item->bidding_area;

                //$epluser = UserEpl::select('name', 'phone', 'email')->where('region_cluster_id', $regional[$key])->get();
                $epluser = UserEpl::select('name', 'phone', 'email')->where('region_cluster_id', $regional[$key])->get();
            
                $nameuser = [];
                $emailuser = [];
                $phoneuser = [];
                
                foreach($epluser as $no => $itemuser){
                    $nameuser[$no] = $itemuser->name;
                    $emailuser[$no] = $itemuser->email;
                    $phoneuser[$no] = $itemuser->phone;
                    $message = "*Dear Operation Region ".$regional_code[$key]." - ".$nameuser[$no]."*\n\n";
                    $message .= "*PO Tracking Reimbursement Region ".$regional_code[$key]." Uploaded on ".date('d M Y H:i:s')."*\n\n";
                    // send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

                    // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
                }    
            }

            \LogActivity::add('[web] PO Fuel Reimbursement - Import');

            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('po-tracking.index');   
        }
    }
}
