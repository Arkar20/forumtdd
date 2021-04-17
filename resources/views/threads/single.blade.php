@extends('layouts.app')

@section('content')
<thread-view  :replycount="{{$thread->replies_count}}" inline-template >
    <div>
<div class="container my-2 border-bottom border-dark text-lg-center d-flex justify-content-between">
            <p class="h3 text-white">A thread created by 
                <a href="{{ route('profile', $thread->author->name) }}" class="text-primary">
                    {{$thread->author->name}}
                </a>
            </p>
            @can('update', $thread)
            <form action="{{$thread->path()}}" method="POST">
                @csrf
                @method('DELETE')
               <button class="btn btn-md btn-danger" type="submit"> Delete</button>
            </form>    
            @endcan
            
        </div>
             <div class="thread-section d-flex justify-content-around container">
                 <div class="thread container mb-4 w-100">
                    @include('threads.section.threadblock')
                </div>
                <div class="thread-info">
                    <div class=" darker mt-4 float-right text-white">
                             {{$thread->author->name}} Created the thread at {{$thread->created_at}}
    and has 
                        <span v-text="replyCounts"></span>
comments.
                    
                </div>
                </div>
             </div>
                
                  
                <div class="reply section">
                    <section>
                <replies :data="{{$thread->replies}}" 
                    @removed="replyCounts--" 
                    @added="replyCounts++"></replies>

    
</section>
                </div>
           
                            
             @if (!auth()->check())
                       <p class="text-center">Please  <a class="text-blue-800" href="{{ route('login') }}">sign in </a>  to create thread</p>
      
    @endif 
         </div>
</thread-view>   
@endsection

{{--         
   
   
<div class="w-75"> 
                                @include('threads.section.threadblock')
                    </div>
                                <div class="reply">
                                    <div class=" my-10 "> 
                                        <h3 class="py-4 uppercase tracking-wider">REplies ({{$thread->replies_count}})</h3>
                                        @forelse ($thread->replies as $reply)
                                                @include('threads.section.replysection')
                                        @empty
                                        <div class="body mx-auto text-gray-500 px-3 py-6">
                                            <p>No Replies</p>
                                        </div>
                                        @endforelse
                                    
                                    </div>
                                </div>
                        </div>  
                    </div>
                    
                    <div class="mx-10 my-10"> 
                         <div class="bg-white rounded-md shadow  mb-4 px-4 py-6">
                                This thread was created at {{$thread->created_at->diffForHumans()}} 
                                by
                                <span class="italic text-blue-400"> {{$thread->author->name}}</span> 
                                and has <span class="italic text-blue-400">  {{$thread->replies_count}} {{Str::plural('reply',$thread->replies_count)}}.</span> 
                         </div>
                </div>
        </div>

    --}}
       