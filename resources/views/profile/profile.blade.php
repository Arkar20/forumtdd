@extends('layouts.app')
@section('content')
<div   class="text-white threads-block container">

            @forelse($activities as $date=>$record)
            <h3 class="text-white">{{$date}}</h3>
            
                @foreach($record as $activity)
                @if (view()->exists('profile.activity.'.$activity->type))
                    @include('profile.activity.'.$activity->type)  
                 @endif

                @endforeach

            @empty
            <h1 class="container text-center text-uppercase">there are no acitvity</h1>

            @endforelse       
        </div>

        </div>
    </div>
        

Re

   @endsection