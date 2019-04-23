@extends('layouts.des')

@section('content')
    <div class="section" style="">
        <div class="row">
            <div class="col s12 m7">
                <div class="card ">
                    <div class="card-content  ">
                        <span class="card-title center">Recognition</span>
                        <p id="res">Choose image from right.</p>
                        <br/>
                        <img width="300" src="" id="photo_name" class="photo_name"/>
                        <br/>

                        <div class="progress hide" id="load">
                            <div class="indeterminate"></div>
                        </div>
                        <button class="btn-flat" id="run" style="width: 100%"
                            onclick="
                            fdata='';
                                $('#load').toggleClass('hide');
                                $('#run').toggleClass('hide');
                                res.innerHTML='';
                                car = '';
                                var photo = $('.photo_name');
                                // var res = document.getElementById('res');
                                // console.log('ss','/run/'+photo.attr('id'))
                                $.get('/run/'+photo.attr('id'), function(data, status){
                                    console.log(JSON.parse(data)['licence_plate']);
                                    car=JSON.parse(data)['licence_plate'];
                                    fdata= fdata + data +'<br/>';
                                    $.get('/api/checkw/'+JSON.parse(data)['licence_plate'], function(data, status){
                                        // console.log(data['allowed']);
                                        if(data['allowed']){
                                            var obj2 = new Object();
                                            obj2.log_info = car + ' Enter';
                                            // var jsonString= JSON.stringify(obj2);
                                        $.post('/api/log', obj2,function(data, status){
                                         });
                                        }
                                        fdata= fdata +JSON.stringify(data);
                                        res.innerHTML=fdata;
                                     $('#load').toggleClass('hide');
                                     $('#run').toggleClass('hide');
                                     });

                                });

                               "
                        >Run</button>
                    </div>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="card ">
                    <div class="card-content ">
                        <span class="card-title center">Newest Images   <a class="waves-effect waves-light btn-small btn-flat right" href="/upload"><i class="material-icons">add</i></a></span>
                        @isset($photos)
                            @foreach($photos as $photo)
                                <div class="fingerprint scanning">
                                    <img width="300" src="{{asset("/images/".$photo["photo_name"])}}" id="{{$photo["photo_name"]}}"
                                        class="hoverable"
                                        onclick="
                                            clicked_img(this.id, this.src);

                                            function clicked_img(clicked_id, src)
                                            {
                                                 var photo_name= $('.photo_name');
                                                 photo_name.attr('src',src);
                                                 photo_name.attr('id',clicked_id);
                                                 // alert(clicked_id +' '+src);
                                            }


                                        "
                                    >
                                </div>
                                <br/>
                            @endforeach
                                <div class="row center">
                                    {{$photos->links()}}
                                </div>
                        @endisset
                        {{--<img class="materialboxed" width="400" src="https://lorempixel.com/800/400/nature/4">--}}
                        {{--<br/>--}}
                        {{--<img class="materialboxed" width="400" src="https://lorempixel.com/800/400/nature/4">--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection