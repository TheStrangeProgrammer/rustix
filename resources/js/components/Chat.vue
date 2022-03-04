<template>
    <div class="chat">
        <div class="d-flex flex-fill chat-wrapper">
            <div v-for="message in messages">

                <message
                    :message="message.text"
                    :user="message.user"
                    :avatar="message.avatar"
                ></message>
            </div>
        </div>

        <form @submit.prevent="submit" class="chat-form">
            <div class="d-flex flex-fill field has-addons has-addons-fullwidth p-2">
                <div class="d-flex flex-fill control is-expanded p-2">
                    <input class="input chat-input flex-fill" type="text" placeholder="Type a message" v-model="newMessage">
                </div>
                <div class="chat-send-div control p-2">
                    <button type="submit" class="chat-send-button button is-danger" :disabled="!newMessage">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props:['user'],
        data () {
            return {
                scroll:true,
                messages: [],
                newMessage: ''
            }
        },
        mounted () {
            this.fetchMessages();
            Echo.channel('chat')
                .listen('NewChatMessage', (e) => {
                    if(e.user != this.user) {
                        this.messages.push({
                            text: e.message,
                            user: e.user,
                            avatar: e.avatar,
                        });
                    }
                    if(document.getElementsByClassName("chat-wrapper")[0].scrollTop +document.getElementsByClassName("chat-wrapper")[0].clientHeight== document.getElementsByClassName("chat-wrapper")[0].scrollHeight){
                        this.scroll=true;
                    }
                });

        },
        updated: function () {
        this.$nextTick(function () {
            if(this.scroll==true){
                this.scroll=false;
                document.getElementsByClassName("chat-wrapper")[0].scrollTop = document.getElementsByClassName("chat-wrapper")[0].scrollHeight;
            }

        })
        },
        methods: {
            fetchMessages() {
                axios.get(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/api/messages`).then(response => {
                    this.messages = response.data;

                })

            },

            submit() {
                axios.post(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/message`, {
                    user: this.user,
                    message: this.newMessage
                }).then((response) => {
                    if(document.getElementsByClassName("chat-wrapper")[0].scrollTop +document.getElementsByClassName("chat-wrapper")[0].clientHeight== document.getElementsByClassName("chat-wrapper")[0].scrollHeight){
                        this.scroll=true;
                    }

                    this.messages.push({
                        text: this.newMessage,
                        user: this.user,
                        avatar:response.data.avatar
                    });

                    this.newMessage = '';
                }, (error) => {
                    console.log(error);
                });

            }
        }
    }
</script>
