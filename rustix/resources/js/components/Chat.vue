<template>
    <div class="d-flex flex-column">
        <div class="chat-wrapper">
            <div v-for="message in messages">

                <message
                    :message="message.text"
                    :user="message.user"
                ></message>
            </div>
        </div>

        <form @submit.prevent="submit" class="p-2 chat-form">
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
        data () {
            return {
                userId: Math.random().toString(36).slice(-5),
                messages: [],
                newMessage: ''
            }
        },
        mounted () {
            Echo.channel('chat')
                .listen('NewChatMessage', (e) => {
                    if(e.user != this.userId) {
                        this.messages.push({
                            text: e.message,
                            user: e.user
                        });
                    }
                });
        },
        methods: {
            submit() {
                axios.post(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/api/message`, {
                    user: this.userId,
                    message: this.newMessage
                }).then((response) => {
                    this.messages.push({
                        text: this.newMessage,
                        user: this.userId
                    });

                    this.newMessage = '';
                }, (error) => {
                    console.log(error);
                });

            }
        }
    }
</script>
