<template lang="pug">
    <li class="nav-item dropdown" v-if="notifications.length">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-text="notifications.length">
                                 
                                </a>
                                 <div  class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   <div v-for="noti in notifications">
                                    <a class="dropdown-item"   v-text="noti.data.message">
                                    </a>
                                   </div>
                                </div>

                               
                             </li>
</template>
<script>
export default {
    name:"notification-dropdown",
    data(){
      return {
        notifications:false
      }
    },
    mounted(){
    axios.get('/profile/'+window.App.authUser.name+'/notifications').then((response)=>{
        this.notifications=response.data
    })
    },
    methods:{
      setAsRead(notification){
        // console.log(id)
        axios.delete('/profile/'+window.App.authUser.name+'/notifications/'+notification.id)
      }
    }
    // /profile/{user}/notifications/{notificationid}
}
</script>