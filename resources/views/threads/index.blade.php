@extends('layouts.app')

@section('content')
    
<div class="threads-block d-flex justify-content-lg-around">
     <div class="thread-section w-100">
            @foreach ($threads as $thread)
            <div class="container">
                @include('threads.section.threadblock')
            </div>
            @endforeach
        </div>
       
        </div>

        
        
{{-- 
    <div class="">
        {{$threads->links()}}
    </div> --}}

    <div class="sigin mb-10 ">
        @if (!auth()->check())   
               <p class="text-center">Please  <a class="text-blue-800" href="{{ route('login') }}">sign in </a>  to create thread</p>
                
            @else
                @include('threads.section.createForm')
            @endif
    </div>
   
@endsection
    
