<div id="export" class="">

    <div class="container">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-body">
                        <div class="portlet light profile-sidebar-portlet bordered">
                            <div class="profile-userpic text-center ">
                                <img src="{{asset('dist/img/avatar5.png')}}" width="50px" height="50px"
                                     class="img-responsive" alt=""></div>
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <input type="text" class="form-control text-center" style="border: none;padding-bottom: 0" value="{{$event->name}}">
                                </div>
                                <div class="profile-usertitle-phone text-center"> {{$event->phone}}</div>
                            </div>
                            <div class="text-left mt-2">
                                <div class="profile-usertitle-email"> Email : {{$event->email}}</div>
                                <div class="profile-usertitle-people"> Number People : {{$event->number_people}}</div>
                            </div>
                            <div class="text-center mt-3">
                                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate(route('event.attend', ['code' => $event->code])) !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
