@if(count($errors)>0)<!--闪存  错误信息-->
<div class="alert alert-warning" role="alert">
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</div>
@endif
