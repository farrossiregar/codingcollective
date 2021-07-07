@section('title', __('Performance KPI'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#commitment-daily">{{ __('Commitment Daily') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#health-check">{{ __('Health Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vehicle-check">{{ __('Vehicle Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ppe-check">{{ __('PPE Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tools-check">{{ __('Tools Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#speed-warning-alarm">{{ __('Speed Warning Alarm') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preventive-maintenance">{{ __('Preventive Maintenance') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drug-test">{{ __('Drug Test') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="commitment-daily">
                    <livewire:mobile-apps.commitment-daily />
                </div>
                <div class="tab-pane" id="health-check">
                    <livewire:mobile-apps.health-check />
                </div>
                <div class="tab-pane" id="vehicle-check">
                    <livewire:mobile-apps.vehicle-check />
                </div>
                <div class="tab-pane" id="ppe-check">
                    <livewire:mobile-apps.ppe-check />
                </div>
                <div class="tab-pane" id="tools-check">
                    <livewire:mobile-apps.tools-check />
                </div>
                <div class="tab-pane" id="speed-warning-alarm">
                    <livewire:mobile-apps.speed-warning-alarm />
                </div>
                <div class="tab-pane" id="preventive-maintenance">
                    <livewire:mobile-apps.preventive-maintenance />
                </div>
                <div class="tab-pane" id="drug-test">
                    <livewire:mobile-apps.drug-test />
                </div>
            </div>
        </div>
    </div>
</div>