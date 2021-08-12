        <div class="comment  mt-4 text-justify ">
            <div class="header py-2">
                 <img src="https://i.imgur.com/yTFUilP.jpg" alt="" class="rounded-circle" width="40" height="40" />
                 <a 
                 href="{{$thread->path()}}"
                 class="text-white text-lg uppercase">
                    
                 @if (auth()->check() && $thread->hasUpdateFor())
                    <strong>
                     {{$thread->author->name}}
                    <span>{{$thread->created_at->diffForHumans()}}</span>
                        <span>unread</span>
                    </strong>
                 @else
                    {{$thread->author->name}}
                    <span>{{$thread->created_at->diffForHumans()}}</span>
                @endif   
                </a> 
                </div>          
                
                        <h4>{{$thread->title}}</h4>
                        <p>{{$thread->body}}</p>
                <span>{{$thread->replies_count}} replies</span>
        </div>

 {{-- <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a  class="" href="{{$thread->path()}}">
                         <h3 class="">
                      {{$thread->title}}
               <span class="">
                        {{$thread->created_at->diffForHumans()}}
                   </span>
                </h3> 
                      </a>
               
                                <p class="inline-block text-lg text-blue-700"> {{$thread->replies_count}} {{Str::plural('reply',$thread->replies_count)}}</p>

              </div>

                    <div class="card-body">
                                        <p>{{$thread->body}}</p>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}