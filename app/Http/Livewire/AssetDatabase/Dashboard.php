<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;

class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year, $type;
    public $labels;
    public $datasets;
    public $labelsamount;
    public $datasetsamount;

    public $category;
    public $project, $dataproject;
    public $region;
    public $totalasset;
    public $aging;
    public $expired;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        // $getproject = \App\Models\ClientProject::where('id', $this->project)
        //         ->where('company_id', Session::get('company_id'))
        //         ->where('is_project', '1')
        //         ->first();

        // if($getproject){
        //     if($getproject->region_id){
        //         $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
        //     }else{
        //         $this->region = '';
        //     }
        // }else{
        //     $this->region = '';
        // }
        $this->dataproject = [];

        if($this->region){
            // dd($this->region);
            $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('region_id', $this->region)
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();
        }

        $this->generate_chart();
        return view('livewire.asset-database.dashboard');
    }

    public function mount()
    {
        $this->year = date('Y');
    }

    public function updated()
    {
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        // $this->labels = [];
        // $this->datasets = [];
        // $this->datasetsamount = [];
        // $this->mo = [];

        $this->totalasset = [];
        $this->aging = [];
        $this->expired = [];

        // if($this->year){
        //     $this->year = $this->year;
        // }else{
        //     $this->year = date('Y');
        // }

        // if($this->month){
        //     $this->month = $this->month;
        // }else{
        //     $this->month = date('m');
        // }

        // if($this->region){
        //     $getregion = \App\Models\Region::where('id', $this->region)->first()->region_code;
            
        // }else{
        //     $getregion = '';
        // }

        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        
        $tickettype = ['1', '2'];
        $reqstatus = ['open', 'reject', 'close'];
        
        
       
        // $monthdata = \App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month);
        // foreach($monthdata->groupBy(DB::Raw('month(created_at)'))->get() as $k => $item){
        //     $this->labels[$k] = date_format(date_create($item->created_at), 'M');
        // }
       
        // $open = count(\App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->whereNull('status')->get());
        // $reject = count(\App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->where('status', '0')->get());
        // $close = count(\App\Models\AssetRequest::whereYear('created_at',$this->year)->where('project', $this->project)->where('region', $getregion)->whereMonth('created_at', $this->month)->where('status', '1')->get());

        // $reqstatus2 = [$open, $reject, $close];
     
        
        // foreach($reqstatus as $k => $status){ 
        
        //     $this->datasets[$k]['label']                = $status;
        //     $this->datasets[$k]['backgroundColor']      = $color[$k];
        //     $this->datasets[$k]['fill']                 = 'boundary';
            
        //     $this->datasets[$k]['data'][]               = $reqstatus2[$k];
        // }


        $total_asset = \App\Models\AssetDatabase::orderBy('id', 'desc');
        if($this->category){
            $total_asset = $total_asset->where('asset_type', $this->category);
        }

        if($this->project){
            $total_asset = $total_asset->where('project', $this->project);
            if($this->region){
                $total_asset = $total_asset->where('region', $this->region);
            }
        }

        $this->totalasset = count($total_asset->get());


        $countaging = 0;
        $aging =  \App\Models\AssetDatabase::orderBy('id', 'desc');
        if($this->category){
            $aging = $aging->where('asset_type', $this->category);
        }
        if($this->project){
            $aging = $aging->where('project', $this->project);
            if($this->region){
                $aging = $aging->where('region', $this->region);
            }
        }

        $aging = $aging->get();
        
        foreach($aging as $k => $item){
            $diff    = abs(strtotime(date('Y-m-d H:i:s')) - strtotime(date_format(date_create($item->created_at), 'Y-m-d H:i:s')));
            $years   = floor($diff / (365*60*60*24)); 
            $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
            $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
            $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
    
            if($years >= 3){
                $countaging = $countaging + 1;
            }
        }
        $this->aging = $countaging;



        $countexpired = 0;
        $expired = \App\Models\AssetDatabase::orderBy('id', 'desc');
        if($this->category){
            $expired = $expired->where('asset_type', $this->category);
        }

        if($this->project){
            $expired = $expired->where('project', $this->project);
            if($this->region){
                $expired = $expired->where('region', $this->region);
            }
        }

        $expired = $expired->get();
        
        foreach($expired as $k => $item){
            $diff    = abs(strtotime(date('Y-m-d H:i:s')) - strtotime(date_format(date_create($item->expired_date), 'Y-m-d H:i:s')));
            $years   = floor($diff / (365*60*60*24)); 
            $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
            $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
            $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
    
            if($days >= 1){
                $countexpired = $countexpired + 1;
            }else{
                $countexpired = 0;
            }
        }


        $this->expired = $countexpired;

    
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);
        
        
        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'totalasset'=>$this->totalasset,'aging'=>$this->aging,'expired'=>$this->expired]);
    }


}



