
@component('profile.activity.activity')

    @slot('header')            
       <p class="h5">
        {{$activity->subject->author->name}} Created the thread on <a class="" href="{{$activity->subject->path()}}">"{{$activity->subject->title}}"</a>
        <span class="text-xs text-gray-400 italic">
            {{$activity->created_at->diffForHumans()}}
        </span>
        </p> 
    @endslot
    @slot('body')
            <p>{{$activity->subject->body}}</p>
    @endslot
@endcomponent