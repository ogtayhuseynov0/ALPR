@extends('layouts.des')

@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card">
                        {{--<div class="card-image text-center">--}}
                        {{--<img src="{{asset('/images/images.png')}}">--}}
                        {{--</div>--}}

                        <div class="card-content center">
                            @isset($success)
                                {{$success}}
                            @endisset

                            <h4>Add Photo</h4>
                            <div class="row">
                                <form class="col s12" role="form" method="POST" action="{{ route('photo.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" name="input_img">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" >
                                        </div>
                                    </div>
                                    <div class="input-field ">
                                        <button type="submit" name="submit" value="Submit"
                                                class="waves-effect waves-light btn white-text "
                                                style=" width: 100%;">
                                            Submit
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection