 
@component('profile.activity.activity')

    @slot('header')
    
                 <p class="h5">
                        {{$activity->subject->owner->name}} commented on <a class="" href="{{$activity->subject->thread->path()}}">"{{$activity->subject->thread->title}}"</a>
                    <span class="text-xs text-gray-400 italic">
                                {{$activity->created_at->diffForHumans()}}
                        </span>
                        </p> 
        
    @endslot
    @slot('body')
            <p>{{$activity->subject->body}}</p>

    @endslot
@endcomponent