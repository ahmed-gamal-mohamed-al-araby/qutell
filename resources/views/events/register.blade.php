@extends('layouts.app')

@section('styles')

    <style>

        .btnSubmit
        {
            border:none;
            border-radius:1.5rem;
            padding: 1%;
            width: 20%;
            cursor: pointer;
            background: #0062cc;
            color: #fff;
        }

        .error {
            color: #F00;
        }

    </style>
@endsection

@section('content')
    <div class="container register-form mt-5">
        <div class="form">
            <div class="note">
                <p>Register to attend the event  .</p>
            </div>

                <div class="card">
                    <div class="card-body">
                        <form action="{{route('register.events.post',$event_id)}}" method="post" id="registerEvents">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" required autocomplete="OFF" class="form-control" id="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" class="form-control" required name="email" autocomplete="Off" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Phone</label>
                                <input type="text" class="form-control" required name="phone" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">The number of people accompanying you</label>
                                <input type="number" name="number_people" required autocomplete="OFF" class="form-control" id="">
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Save <i class="fa fa-save"></i> </button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#registerEvents").validate();
        $('#registerEvents').submit(function (e) {
            var validation = $("#registerEvents").valid();

            if (!validation) {
                e.preventDefault();
                return;
            }
            $('#loader_new').show();

        });
    </script>
@endsection
