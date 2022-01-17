<template>
    <div class="d-flex flex-column">
        <div class="d-flex flex-fill chat-wrapper">
            <div v-for="message in messages">

                <message
                    :message="message.text"
                    :user="message.user"
                ></message>
            </div>
        </div>

        <form @submit.prevent="submit" class="chat-form">
            <div class="field has-addons has-addons-fullwidth d-flex p-2">
                <div class="control is-expanded p-2">
                    <input class="input chat-input" type="text" placeholder="Type a message" v-model="newMessage">
                </div>
                <div class="control p-2">
                    <button type="submit" class="button is-danger" :disabled="!newMessage">
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
            user:String
            },
        data () {
            return {
                messages: [],
                newMessage: ''
            }
        },
        mounted () {
            //this.fetchMessages();
            Echo.channel('chat')
                .listen('NewChatMessage', (e) => {
                    if(e.user != this.user) {
                        this.messages.push({
                            text: e.message,
                            user: e.user
                        });
                    }
                });
        },
        methods: {
            /*fetchMessages() {
                axios.get(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/api/messages`).then(response => {
                    this.messages = response.data;
                })
            },*/

            submit() {
                axios.post(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/api/message`, {
                    user: this.user,
                    message: this.newMessage
                }).then((response) => {
                    this.messages.push({
                        text: this.newMessage,
                        user: this.user
                    });

                    this.newMessage = '';
                }, (error) => {
                    console.log(error);
                });

            }
        }
    }
</script>
