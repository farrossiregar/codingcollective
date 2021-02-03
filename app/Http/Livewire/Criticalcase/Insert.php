<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class Insert extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.criticalcase.insert');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);
        
        $users = Auth::user();

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        // $data                   = new \App\Models\Criticalcase();
        // $data->name             = $users->name;
        // $data->upload_by        = $users->name;
        // $data->status           = '0';
        // $data->save();
        
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $criticalcase = new \App\Models\Criticalcase();
                if($i[0]!="") 
                
                
                $criticalcase->pic                                    = $i[1];
                $criticalcase->shift_number                           = $i[2];
                $criticalcase->date                                   = date_format(date_create($i[3]), 'Y-m-d');
                $criticalcase->activity_handling                      = $i[4];
                $criticalcase->time_occur                             = $i[5];
                $criticalcase->severity                               = $i[6];
                $criticalcase->project                                = $i[7];
                $criticalcase->region                                 = $i[8];
                $criticalcase->category                               = $i[9];
                $criticalcase->impact                                 = $i[10];
                $criticalcase->action                                 = $i[11];
                $criticalcase->customer_handling                      = $i[12];
                $criticalcase->time_closed                            = date_format(date_create($i[13]), 'Y-m-d H:i:s');
                $criticalcase->status                                 = $i[14];
                $criticalcase->last_update                            = $i[15];
                $criticalcase->created_at                             = date('Y-m-d');
                $criticalcase->updated_at                             = date('Y-m-d');
                $criticalcase->save();

                // $datadetailcek  = \App\Models\SiteListTrackingDetail::where('no_po', $i[2])->get();
                
                // if($datadetailcek->count() > 0){
                //     $datatemp       = new \App\Models\SiteListTrackingTemp();
                //     $datatemp->id_site_master                         = $data->id;
                //     $datatemp->collection                             = date_format(date_create($i[4]), 'm');;
                //     $datatemp->no_po                                  = $i[2];
                //     $datatemp->item_number                            = $i[3];
                //     $datatemp->date_po_release                        = date_format(date_create($i[4]), 'Y-m-d');
                //     $datatemp->pic_rpm                                = $i[5];
                //     $datatemp->pic_sm                                 = $i[6];
                //     $datatemp->type                                   = $i[7];
                //     $datatemp->item_description                       = $i[8];
                //     $datatemp->period                                 = date_format(date_create($i[9]), 'Y-m');
                //     $datatemp->region                                 = $i[10];
                //     $datatemp->region1                                = $i[11];
                //     $datatemp->project                                = $i[12];
                //     $datatemp->penalty                                = $i[13];
                //     $datatemp->last_status                            = $i[14];
                //     $datatemp->remark                                 = $i[15];
                //     $datatemp->qty_po                                 = $i[16];
                //     $datatemp->actual_qty                             = $i[17];
                //     $datatemp->no_bast                                = $i[18];
                //     $datatemp->date_bast_approval                     = date_format(date_create($i[19]), 'Y-m-d');
                //     $datatemp->date_bast_approval_by_system           = date_format(date_create($i[20]), 'Y-m-d');
                //     $datatemp->date_gr_req                            = $i[21];
                //     $datatemp->no_gr                                  = $i[22];
                //     $datatemp->date_gr_share                          = $i[23];
                //     $datatemp->no_invoice                             = $i[24];
                //     $datatemp->inv_date                               = date_format(date_create($i[25]), 'Y-m-d');
                //     $datatemp->payment_date                           = date_format(date_create($i[26]), 'Y-m-d');
                //     $datatemp->created_at                             = date('Y-m-d');
                //     $datatemp->updated_at                             = date('Y-m-d');
                //     $datatemp->save();
                // }else{
                //     $datadetail->save();
                // }

                

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('site-tracking.index');
        }
    }
}
