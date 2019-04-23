@extends('layouts.des')

@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card">
                        <div class="card-image text-center">
                            <img src="{{asset('/images/images.png')}}">
                        </div>
                        <div class="card-content center">
                            <h5>{{$car[0]["licence_plate"]}}<br> {{$car[0]["model"]}}</h5>

                            <table class="">
                                <tbody>
                                <tr>
                                    <td>Color</td>
                                    <td>{{$car[0]["color"]}}</td>
                                </tr>
                                <tr class="centered">
                                    <td>Owner Name</td>
                                    <td class="centered"><a
                                                href="/user/{{$car[0]["user_id"]}}">{{$owner->name}}  {{$owner->surname}}</a>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                            @if(\Illuminate\Support\Facades\Auth::id()==$car[0]["user_id"])
                                <br/>
                                <a onclick="
                                        console.log('aaaa','/api/car/{{$car[0]["id"]}}');
                                        $.ajax({
                                        url: '/api/car/{{$car[0]["id"]}}',
                                        type: 'DELETE',
                                        contentType: 'application/json',
                                        success: function(response) {
                                        window.location.href = '/user/{{$car[0]["user_id"]}}';
                                        }
                                        });

                                        " class="waves-effect waves-light btn red white-text "><i
                                            class="material-icons left">close</i>Delete</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection