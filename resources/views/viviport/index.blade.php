@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

                <div class="row">

                        @foreach($filelists as $file)
                        <div class="col-md-3 item-normal">
                            <a  href="product/{{$file->id}}"  target="_blank">
                            <div>
                                    <img style="width: 100%; height: 100%;" src="http://www.w3school.com.cn/i/eg_tulip.jpg"  alt="上海鲜花港 - 郁金香" />
                            </div>
                            <div>
                                <p> {{$file->notes}} </p>
                            </div>
                            </a>
                        </div>
                        @endforeach

                </div>

                <div style="display: flex;flex-direction: row; justify-content: center;">

                        {{ $filelists->links() }}

                </div>




            </div>
          </div>
        </div>
    </div>
@endsection


