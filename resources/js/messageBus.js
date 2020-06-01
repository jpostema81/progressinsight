import Vue from 'vue';

// from: https://alligator.io/vuejs/global-event-bus/

const MessageBus = new Vue();

const messageHandler = function({ message, variant })
{    
    this.$app.$bvToast.toast(message, 
    {
        title: 'Notificatie',
        toaster: 'b-toaster-top-right',
        solid: true,
        autoHideDelay: 2000,
        appendToast: true,
        variant,
    })
}

MessageBus.$on('message', messageHandler);

export default MessageBus;