<div class="container section-marginTop text-center">
    <h1 class="section-title">Services </h1>
    <h1 class="section-subtitle">IT Course, Project Based Source Code and All Other Services That We Provide </h1>
    <div class="row">
        @foreach($serviceData as $data)
        <div class="col-md-3 p-2 ">
            <div class="card service-card text-center w-100">
                <div class="card-body">
                    <img class="service-card-logo " src="{{ $data['service_img'] }}" alt="Card image cap">
                    <h5 class="service-card-title mt-3">{{ $data['service_name'] }}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{ $data['service_des'] }}</h6>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
