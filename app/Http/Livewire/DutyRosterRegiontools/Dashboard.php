<?php

namespace App\Http\Livewire\DutyRosterRegiontools;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\AccidentReport;
use App\Models\RegionTools;
use Auth;
use DB;


class Dashboard extends Component
{
    use WithPagination;
    public $date, $site_id, $employee_id, $keyword,$employees;
    // public $month;
    // public $year;
    // public $labels;
    // public $datasets;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        
        // $this->generate_chart();

        $data = RegionTools::orderBy('id', 'desc');
        // if($this->date) $ata = $data->whereDate('date',$this->date);
        // if($this->employee_id) $ata = $data->where('employee_id',$this->employee_id);
        // if($this->keyword) $data->where(function($table){
        //     $table->where("site_id","LIKE","%{$this->keyword}%")
        //             ->orWhere('klasifikasi_insiden',"LIKE","%{$this->keyword}%")
        //             ->orWhere('jenis_insiden',"LIKE","%{$this->keyword}%")
        //             ->orWhere('rincian_kronologis',"LIKE","%{$this->keyword}%")
        //             ->orWhere('nik_and_nama',"LIKE","%{$this->keyword}%");
        // });
                        
        return view('livewire.duty-roster-regiontools.dashboard')->with(['data'=>$data->paginate(50)]);
        
    }

    public function mount()
    {
        $this->employees = AccidentReport::select(['employees.id','employees.name'])->join('employees','employees.id','=','accident_report.employee_id')->whereNotNull('employee_id')->groupBy('employee_id')->get();
    }

    // public function updated()
    // {
    //     // if($propertyName=='year') $this->month = '';
    //     $this->generate_chart();
    // }
    
    // public function generate_chart()
    // {
    //     $this->labels = [];
    //     $this->datasets = [];

    //     // $this->year = '2021';
    //     // $this->month = '07';


    //     foreach(\App\Models\AccidentReport::select('week')
    //                                         ->where(DB::Raw('year(date)'),$this->year)
    //                                         ->where(DB::Raw('month(date)'),$this->month)
    //                                         ->groupBy('week')
    //                                         ->orderBy('week', 'asc')->get() as $k => $item){
    //         $this->labels[] = 'Week '.$item->week;
    //     }

    //     foreach(\App\Models\AccidentReport::select('accident_report.*', DB::Raw('year(date) as year'), DB::Raw('month(date) as month'))
    //                                         ->where(DB::Raw('year(date)'),$this->year)
    //                                         ->where(DB::Raw('month(date)'),$this->month)
    //                                         ->groupBy('week')
    //                                         ->orderBy('week', 'asc')
    //                                         ->get() as $k => $item){
            
    //         // $colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    //         $colors = '#007bff';
    //         $this->datasets[] = [];
    //         // $this->datasets = [];
    //         // $weeks = $item
            
    //         foreach(\App\Models\AccidentReport::select(DB::Raw('count(id) as jumlah_accident'), 'week', 'klasifikasi_insiden')
    //                                             ->where(DB::Raw('year(date)'),$item->year)
    //                                             ->where(DB::Raw('month(date)'),$item->month)
    //                                             ->where('week', $item->week)
    //                                             ->groupBy('week')
    //                                             // ->groupBy('klasifikasi_insiden')
    //                                             ->get() as $l => $itemweek){
           

    //             $this->datasets[$k]['label'] = 'Weeks '.$item->week;
    //             $this->datasets[$k]['backgroundColor'] = $colors;
    //             $this->datasets[$k]['fill'] = 'boundary';
    //             $this->datasets[$k]['data'] = [];
    //             // $this->datasets[$k]['backgroundColor'][] = $colors;
    //             $this->datasets[$l]['data'][] = $itemweek->jumlah_accident;

                
    //         }
    //     }
       
       
    //     $this->labels = json_encode($this->labels);
    //     // dd($this->labels);

    //     $this->datasets = json_encode($this->datasets);
    //     // dd($this->datasets);

    //     $this->emit('init-chart-acc',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    // }


}


