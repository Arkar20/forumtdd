           
     <div class="w-100 darker mt-4 float-right">
                        <div class="header d-flex justify-content-start " style="transition:all 3s;">
                            <div class="">
                                 <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle mx-2" width="40" height="40">     
                            </div>
                            <div>
                                <h4 v-text="replyname"> </h4> <span v-text="created">- </span> <br>
                            
                            @can('delete',$reply)
                              <button type="button"  class="btn d-inline p-0 m-0" style="color:gray" @click="destroy" >Delete |</button>
                                <button type="submit"  class="btn d-inline p-0 m-0" style="color:gray" @click="editing = !editing">Edit</button>

                            @endcan
                                
                            </div>
                           
                           
                        </div>    
                      <div class="d-flex justify-content-between m-2">
                             <p v-text="body"  v-show="!editing"></p>
                           
                          
                            <favourite-component :data="this.data"></favourite-component>
                          

                      </div>
                    <div class="d-flex justify-content-center mb-3" v-if="editing">
                    <input type="text" class="form-control mx-4 text-white" style="background-color: black;" v-model="body" />
                      <button type="button" class=" btn btn-outline-primary" @click="update">Update</button>
                    </div>
                    
                    
                </div>
                 <div>
                            </div>
                            </div>

                         
