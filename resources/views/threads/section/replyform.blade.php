 <form id="algin-form" action="{{$thread->path() .'/replies'}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <h4>Leave a comment</h4> <label for="message">Message</label> 
                        <textarea name="body" id="" msg cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
                    </div>
                    {{-- <div class="form-group"> <label for="name">Name</label> <input type="text" name="name" id="fullname" class="form-control"> </div>
                    <div class="form-group"> <label for="email">Email</label> <input type="text" name="email" id="email" class="form-control"> </div> --}}
                    <div class="form-group">
                        <p class="text-secondary">If you have a <a href="#" class="alert-link">gravatar account</a> your address will be used to display your profile picture.</p>
                    </div>
                    <div class="form-inline"> <input type="checkbox" name="check" id="checkbx" class="mr-1"> <label for="subscribe">Subscribe me to the newlettter</label> </div>
                    <div class="form-group"> <button type="submit" id="post" class="btn">Post Comment</button> </div>
                </form>