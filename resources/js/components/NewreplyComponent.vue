<template>
<div>
    <div class="form-group" v-if="isAuth">
        <h4>Leave a comment</h4> <label for="message">Message</label> 
        <textarea v-model="body" id="" msg cols="30" rows="5" class="form-control" style="background-color: black;"></textarea>
    </div>
    <div class="form-group">
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
               endpoint:'',
           }
       },
       computed:{
           isAuth(){
               return window.App.signedIn;
           }
       },
       methods:{
           addReply(){
               axios.post('/threads/sit/55/replies',{body:this.body}).then(
                   (response=>{
                       this.body=''
                        this.$emit('added',response.data)
                        alert.fire({    
                        icon: 'success',
                        title: 'Reply Created Successful'
                })
                   })
               )
           }
       }

   }
    </script>
    