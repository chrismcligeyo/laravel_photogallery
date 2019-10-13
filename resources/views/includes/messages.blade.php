@if(count($errors) > 0)

    @foreach($errors->all() as $error)
    <li class="bg-danger">{{$error}}</li>
    @endforeach
 @endif


@if(session()->has('success'))

    <div class="alert alert-success">
        <p>{{session('success')}}</p>
    </div>

    @endif




@if(session('fail'))

    <div class="alert alert-danger">
        <p>{{session('fail')}}</p>
    </div>

@endif