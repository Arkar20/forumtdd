<template>
    <div>
                   
     <div class="w-100 darker mt-4 float-right">
                        <div class="header d-flex justify-content-start " style="transition:all 3s;">
                            <div class="">
                                 <img src="https://i.imgur.com/CFpa3nK.jpg" alt="" class="rounded-circle mx-2" width="40" height="40">     
                            </div>
                            <div>
                                <h4 v-text="replyname"> </h4> <span v-text="created">- </span> <br>
                            
                            <!-- @can('delete',$reply) -->
                            <div v-if="canUpdate">
                              <button type="button"  class="btn d-inline p-0 m-0" style="color:gray" @click="destroy" >Delete |</button>
                                <button type="submit"  class="btn d-inline p-0 m-0" style="color:gray" @click="editing = !editing">Edit</button>
                            </div>
                            <!-- @endcan -->
                                
                            </div>
                           
                           
                        </div>    
                      <div class="d-flex justify-content-between m-2">
                             <p v-text="body"  v-show="!editing"></p>
                           
                        <!-- @if(auth()->check())   -->
                        <div v-if="signIn">
                            <favourite-component :data="this.data"></favourite-component>
                          <!-- @endif -->
                         </div> 

                      </div>
                    <div class="d-flex justify-content-center mb-3" v-if="editing">
                    <input type="text" class="form-control mx-4 text-white" style="background-color: black;" v-model="body" />
                      <button type="button" class=" btn btn-outline-primary" @click="update">Update</button>
                    </div>
                    
                    
                </div>
                
                         

    </div>
</template>
<script>
import alert from "./alert.mjs"
import FavouriteComponent from './FavouriteComponent.vue'
export default {
  components: { FavouriteComponent },

    props:['data'],
    data() {
        return {
            body:this.data.body,
            replyname:this.data.owner.name,
            created:this.data.owner.created_at,
            editing:false
        }
    },
    computed:{
        signIn(){
            return window.App.signedIn
        },
        canUpdate(){
            return this.authorize(handler=> handler.id=== this.data.owner.id);
        },
    },
    methods:{
        update(){
            axios.patch('/replies/'+this.data.id,{
                body:this.body
            })
            
            alert.fire({
                icon: 'success',
                title: 'Reply Updated Successful'
                })

                this.editing=false
        },
        destroy(){
             axios.delete('/replies/'+this.data.id)
            this.$emit('deleted',this.data.id);
            
            //  $(this.$el).fadeOut(1000,()=>{
            //     alert.fire({    
            //     icon: 'success',
            //     title: 'Reply Deleted Successful'
            //     })
            //  })
               
        }
    }
}
</script>