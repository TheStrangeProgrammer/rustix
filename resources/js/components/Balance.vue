<template>
    <span class="balance">
        $<span id="balance">{{ balance }}</span>
    </span>
</template>

<script>
    export default {
        props: [
            'user'
        ],
        data() {
            return {
                balance: 0
            }
        },
        mounted () {
            this.fetchBalance();
            Echo.private(`balance.${this.user}`)
                .listen('NewBalance', (e) => {
                    this.balance = e.balance;
                });


        },
        methods:{
            fetchBalance(){
                axios.post(`${process.env.MIX_WEBSOCKET_SERVER_BASE_URL}/api/balance`,{
                    user: this.user
                }).then((response) => {
                    this.balance = response.data;
                })
            }
        }
    }
</script>
