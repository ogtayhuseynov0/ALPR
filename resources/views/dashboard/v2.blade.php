@extends('layouts.des')

@section('content')

    <ul id="slide-out" class="sidenav sidenav-fixed" STYLE=" header, main, footer{
      padding-left: 300px;
    };

    padding-top:60px;

    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
    }">
        <li id="aaaa"><a><h4><i class="material-icons">dashboard</i>Dashboard</h4></a></li>
        <li class="{{request()->segment(count(request()->segments()))=="car" ? "activem": ""}}"><a
                    href="/dashboard/car"><i class="material-icons">directions_car</i>Car Management</a></li>
        <li class="{{request()->segment(count(request()->segments()))=="user" ? "activem": ""}}"><a
                    href="/dashboard/user"><i class="material-icons">account_circle</i>User Management</a></li>
        <li class="{{request()->segment(count(request()->segments()))=="perm" ? "activem": ""}}"><a
                    href="/dashboard/perm"><i class="material-icons">lock</i>Permission Management</a>
        <li class="{{request()->segment(count(request()->segments()))=="log" ? "activem": ""}}"><a
                    href="/dashboard/log"><i class="material-icons">format_list_bulleted</i>Logs</a></li>
        <li class="" style="margin-top: 95%"><a href="{{route("recognise")}}" class="btn">Recognise</a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    <div class="container center-block">
        @if(request()->segment(count(request()->segments()))=="log")
            <div class="row">
                <nav>
                    <div class="nav-wrapper">
                        <form action="/dashboard/log" method="GET">
                            {{--@csrf--}}
                            <div class="input-field">
                                <input id="search" type="search" name="query" required placeholder="Type Log Text"
                                       onfocus="$('.xclose').toggleClass('white-text')"
                                       onblur="$('.xclose').toggleClass('white-text')">
                                <label class="label-icon" for="query"><i
                                            class="material-icons white-text xclose">search</i></label>
                                <i class="material-icons white-text xclose"
                                   onclick="window.location.href = '/dashboard/log';">close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
            <ul class="collection with-header">

                @foreach($logs as $arr2)
                    <li class="collection-item">
                        <div>{{$arr2->log_info}}<a href="#!" class="secondary-content">{{$arr2->created_at}}</a></div>
                    </li>
                @endforeach
            </ul>
            <div class="row center">
                {{$logs->links()}}
            </div>
            <div class="row center">
                @isset($chart)
                    {!! $chart->container() !!}
                @endisset
            </div>
            <div class="row center">
                @isset($chart2)
                    {!! $chart2->container() !!}
                @endisset
            </div>
        @endif
        @if(request()->segment(count(request()->segments()))=="car")
            <div class="row">
                <nav>
                    <div class="nav-wrapper">
                        <form action="/dashboard/car" method="GET">
                            {{--@csrf--}}
                            <div class="input-field">
                                <input id="search" type="search" name="query" required placeholder="Type Licence Plate"
                                       onfocus="$('.xclose').toggleClass('white-text')"
                                       onblur="$('.xclose').toggleClass('white-text')">
                                <label class="label-icon" for="query"><i
                                            class="material-icons white-text xclose">search</i></label>
                                <i class="material-icons white-text xclose" id="xlose"
                                   onclick="window.location.href = '/dashboard/car';">close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
            <ul class="collection with-header">
                @foreach($logs as $arr2)
                    <li class="collection-item">
                        <div>
                            <a href="/car/{{$arr2->licence_plate}}">{{$arr2->licence_plate}}</a>


                            <a href="#modal1" class="red-text right modal-trigger" id="{{$arr2->id}}"
                               onclick="giveid(this.id)">&nbsp; Delete &nbsp; </a>
                            @if(\App\CarPermission::where("l_p", '=',$arr2->licence_plate)->count()>0)
                                <a href="#modal2" class="blue-grey-text right modal-trigger" id="{{$arr2->licence_plate}}"
                                   onclick="giveplate(this.id)">&nbsp; Whitelist &nbsp; </a>
                            @else
                                <a href="approve/{{$arr2->licence_plate}}" class="orange-text right" id="{{$arr2->id}}">&nbsp; Approve &nbsp; </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="row center">
                {{$logs->links()}}
            </div>

            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4>Delete Car</h4>
                    <p class="red-text">Do you agree to delete this car?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-ripple red white-text btn-flat"
                       onclick="
                                   $.ajax({
                                   url: '/api/car/'+deletedid,
                                   type: 'DELETE',
                                   contentType: 'application/json',
                                   success: function(response) {
                                   window.location.href = '/dashboard/car';
                                   }
                                   });

                                   "
                    >Agree</a>
                    <a href="#!" class="modal-close waves-effect waves-blue btn-flat">Disagree</a>
                </div>
            </div>

            {{--<div id="modal2" class="modal">--}}
                {{--<div class="modal-content">--}}
                    {{--<h4 id="mhead">Whitelist Car</h4>--}}
                    {{--<div class="row">--}}
                        {{--<form role="form" action="{{route("whitelist.s")}}" method="post">--}}
                            {{--<input type="hidden" name="licence_plate" required value="" id="licence_plate">--}}
                            {{--@csrf--}}
                            {{--<div class="input-field ">--}}
                                {{--<input placeholder="Time Interval ex. 1, 20, 30" id="time_difference" type="number"--}}
                                       {{--name="time_difference" class="validate" required>--}}
                                {{--<label for="time_difference">Time Interval</label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field">--}}
                                {{--<select name="time_type" id="time_type">--}}
                                    {{--<option value="MINUTE" selected>MINUTE</option>--}}
                                    {{--<option value="HOUR">HOUR</option>--}}
                                    {{--<option value="DAY">DAY</option>--}}
                                    {{--<option value="MONTH">MONTH</option>--}}
                                    {{--<option value="YEAR">YEAR</option>--}}
                                {{--</select>--}}
                                {{--<label>Select Time Type</label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field ">--}}
                                {{--<button type="submit" name="submit" value="Submit"--}}
                                        {{--class="waves-effect waves-light btn white-text "--}}
                                        {{--style=" width: 100%;"--}}
                                {{-->--}}
                                    {{--Submit--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}


                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

                <div id="modal2" class="modal">
                    <div class="modal-content">
                        <h4 id="mhead">Whitelist Car</h4>
                        <div class="row">
                            <form role="form" action="{{route("whitelist.sr")}}" method="post" class="col s12">
                                <input type="hidden" name="licence_plate" required value="" id="licence_plate">
                                @csrf
                                <div class="row" id="fromdot">
                                    <div class="input-field col m6">
                                        <input type="text" class="datepicker" name="fdate" id="fdate" placeholder="Date from" required>
                                        <label for="fdate">From Date</label>
                                    </div>
                                    <div class="input-field col m6">
                                        <input type="text" class="timepicker" name="ftime" id="ftime" placeholder="Time from" required>
                                        <label for="ftime">From Time</label>
                                    </div>
                                </div>
                                <div class="row scale-transition scale-out hide fsss" id="fsss">
                                    <div class="input-field col m6">
                                        <input type="text" class="datepicker" name="tdate" id="tdate" placeholder="Date To" required>
                                        <label for="tdate">To Date</label>
                                    </div>
                                    <div class="input-field col m6">
                                        <input type="text" class="timepicker" name="ttime" id="ttime" placeholder="Time To" required>
                                        <label for="ttime">To Time</label>
                                    </div>
                                </div>

                                <a href="#" class="btn-flat center" onclick="
                                    var element = document.getElementById('fsss');
                                    var element4 = document.getElementById('fromdot');
                                    var element2 = document.getElementById('next');
                                    var element3 = document.getElementById('subbut');
                                      element.classList.toggle('hide');


                                      // sleep time expects milliseconds
                                    function sleep (time) {
                                      return new Promise((resolve) => setTimeout(resolve, time));
                                    }
                                    // Usage!
                                    sleep(100).then(() => {
                                        // Do something after the sleep!
                                        element.classList.toggle('scale-out');
                                        element2.classList.toggle('hide');
                                        element3.classList.toggle('hide');
                                        element4.classList.toggle('hide');

                                    });

                                        " id="next" style="width: 100%">Next</a>

                                <div class="input-field hide" id="subbut">
                                    <button type="submit" name="submit" value="Submit"
                                            class="waves-effect waves-light btn white-text "
                                            style=" width: 100%;"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>

        @endif
        @if(request()->segment(count(request()->segments()))=="user")
            <div class="row">
                <nav>
                    <div class="nav-wrapper">
                        <form action="/dashboard/user" method="GET">
                            {{--@csrf--}}
                            <div class="input-field">
                                <input id="search" type="search" name="query" required placeholder="Type User Name"
                                       onfocus="$('.xclose').toggleClass('white-text')"
                                       onblur="$('.xclose').toggleClass('white-text')">
                                <label class="label-icon" for="query"><i
                                            class="material-icons white-text xclose">search</i></label>
                                <i class="material-icons white-text xclose"
                                   onclick="window.location.href = '/dashboard/user';">close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </div>
            <ul class="collection with-header">

                @foreach($logs as $arr2)
                    <li class="collection-item">
                        <div> <a href="/user/{{$arr2->id}}">{{$arr2->name}}</a>
                            <a href="user/delete/{{$arr2->id}}" class="red-text right" id="{{$arr2->id}}">&nbsp; Delete &nbsp; </a>
                             @if(\App\UserPermission::where("user_id", '=',$arr2->id)->count()>0)
                                <a href="#" class="blue-grey-text right" id="{{$arr2->id}}">&nbsp; Approved &nbsp; </a>
                            @else
                                <a href="user/approve/{{$arr2->id}}" class="orange-text right" id="{{$arr2->id}}">&nbsp; Approve &nbsp; </a>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="row center">
                {{$logs->links()}}
            </div>
        @endif
        @if(request()->segment(count(request()->segments()))=="perm")

                @if(isset($logs[0]))

                    <div class="row">
                        <nav>
                            <div class="nav-wrapper">
                                <form action="/dashboard/perm" method="GET">
                                    {{--@csrf--}}
                                    <div class="input-field">
                                        <input id="search" type="search" name="query" required placeholder="Type Licence Plate"
                                               onfocus="$('.xclose').toggleClass('white-text')"
                                               onblur="$('.xclose').toggleClass('white-text')">
                                        <label class="label-icon" for="query"><i
                                                    class="material-icons white-text xclose">search</i></label>
                                        <i class="material-icons white-text xclose"
                                           onclick="window.location.href = '/dashboard/perm';">close</i>
                                    </div>
                                </form>
                            </div>
                        </nav>
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>Licence Plate</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($logs as $arr2)
                            <tr>
                                <td><a href="/car/{{$arr2->licence_plate}}"> {{$arr2->licence_plate}} </a></td>
                                <td>{{$arr2->from}}</td>
                                <td>{{$arr2->to}}</td>
                                <td>
                                    <a href="#" class="red-text right modal-trigger" id="{{$arr2->id}}"
                                       onclick="
window.location.href='/whitelist/'+this.id;
">&nbsp; Delete &nbsp; </a>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{--<ul class="collection with-header">--}}
    {{----}}
                        {{--@foreach($logs as $arr2)--}}
                            {{--<li class="collection-item">--}}
                                {{--<div><a href="/car/{{$arr2->licence_plate}}"> {{$arr2->licence_plate}} </a>--}}
                                    {{--left {{intval($arr2->time_difference)- intval(now()->diff($arr2->updated_at)->i)}}--}}
                                    {{--Minutes--}}
                                    {{--<a href="#" class="blue-grey-text right " id="{{$arr2->licence_plate}}"--}}
                                       {{--onclick="giveplate(this.id)">&nbsp; Edit &nbsp; </a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                @else
                    <div>
                        <div class="col s12">
                            <div class="card ">
                                <div class="card-content ">
                                    <p class="text-warning">
                                        There is no car in WhiteList.
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row center">
                    {{$logs->links()}}
                </div>
        @endif

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
                container: 'body',
                format: 'yyyy-mm-dd',
                minDate: new Date(Date.now()),
                defaultDate: new Date(Date.now())
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.timepicker');
            var instances = M.Timepicker.init(elems, {
                container: 'body',
                twelveHour: false
            });
        });

        function giveid(id) {
            deletedid = id;
        }

        function giveplate(palte) {
            wplate = palte;
            $('#mhead').html('Whiellist Car ' + palte);
            $('#licence_plate').val(palte);
        }

    </script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>--}}
    @isset($chart)
    {!! $chart->script() !!}
    {!! $chart2->script() !!}
    @endisset
@endsection