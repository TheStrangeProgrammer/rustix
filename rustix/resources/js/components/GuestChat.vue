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


    </div>
</template>

<script>
    export default {
        data () {
            return {
                messages: [],
                newMessage: ''
            }
        },
        mounted () {
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
    }
</script>
