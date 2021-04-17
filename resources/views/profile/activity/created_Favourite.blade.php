 
@component('profile.activity.activity')

    @slot('header')
    
                 <p class="h5">
          {{$activity->subject->favourited->body}} Reacted on 
        
    @endslot
    @slot('body')
            {{-- <p>{{$activity->subject->body}}</p> --}}

    @endslot
@endcomponent