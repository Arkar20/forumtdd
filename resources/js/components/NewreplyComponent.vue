<template>
<div>
    <div class="form-group" v-if="isAuth">
        <h4>Leave a comment</h4> <label for="message">Message</label> 
        <textarea v-model="body" id="" msg cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
    </div>
    <div class="form-group" >
        <!-- <div v-show="error.span" v-for="error in error.span" v-key="error"> -->
        <p class="alert alert-danger" v-show="error" v-text="error[0]"></p>

        <!-- </div> -->
        <!-- <p class="alert alert-danger"  v-for="span in error.span" key="span" v-text="span"></p> -->
        <p class="text-secondary">If you have a <a href="#" class="alert-link">gravatar account</a> your address will be used to display your profile picture.</p>
    </div>
    <div class="form-inline"> <input type="checkbox" name="check" id="checkbx" class="mr-1"> <label for="subscribe">Subscribe me to the newlettter</label> </div>
    <div class="form-group"> <button type="button" @click="addReply" id="post" class="btn">Post Comment</button> </div>
</div>
</template>
    <script>

    import alert from "../components/alert.mjs"
   export default{
       data(){
           return {
               body:'',
               endpoint:location.pathname,
               error:false,
           }
       },
       computed:{
           isAuth(){
               return window.App.signedIn;
           }
       },
       methods:{
           addReply(){
               axios.post(this.endpoint+'/replies',{body:this.body})
               .catch((error)=>{
                   this.error=error.response.πapp.errors.body
                   console.log(this.error)
                   })
               .then(
                   (response=>{
                       this.body=''
                        this.$emit('added',response.data)
                      
                   })
               )
           }
       },
   }
    </script>
    