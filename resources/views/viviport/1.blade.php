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
            <div id="main">

                
                {{$filelist->download_url}}
                <a href="{{$filelist->download_url}}"  download="{{$filelist->pre_entry_id}}{{$filelist->dot_ext}}"> 下载 </a>


            </div>
          </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){








    });
</script>
@endsection


