require('./bootstrap');
import Vue from 'vue'

window.Vue = require('vue');
// for notificationst
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
Vue.use(Toaster, {timeout: 1000})

Vue.component('messege', require('./components/messege.vue').default);
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

const app = new Vue({
    el: '#app',
    data:{
        messege:'',
        typing:'',
        numberusers:0,
        chat:{
            messege:[],
            user:[],
            color:[],
            time:[]
        }
    },
    watch:{
          messege(){
            Echo.private('chat')
            .whisper('typing', {
                name: this.messege
            });
          }
    },
    methods:{
        send(){
            if (this.messege.length != 0) {
                {
                    this.chat.messege.push(this.messege);
                    this.chat.user.push('You');
                    this.chat.color.push('success');
                    this.chat.time.push(this.getTime());
                    axios.post('/send', {
                        messege : this.messege
                      })
                      .then(response => {
                        this.messege='';
                      })
                      .catch(error => {
                        console.log(error);
                      });
                }
            }
         },
         getTime(){
             let time = new Date();
             return time.getHours()+":"+time.getMinutes();
         }
    },
    mounted()
    {
        Echo.private('chat')
        .listen('ChatEvent', (e) => {
            this.chat.messege.push(e.messege);
            this.chat.user.push(e.user);
            this.chat.time.push(this.getTime());
            this.chat.color.push('danger');
        }).listenForWhisper('typing', (e) => {
            if(e.name != ''){

                this.typing = 'typing....'
            } 
            else{
                this.typing = ''
            }
        });
        Echo.join(`chat`)
            .here((users) => {
                this.numberusers = users.length;
            })
            .joining((user) => {
                this.numberusers+=1;
                this.$toaster.success(user.name+' Joined')

            })
            .leaving((user) => {
                this.$toaster.error(user.name+' Left')
                this.numberusers-=1;
            });
    }
});
