<template>
  <div>
    <div id="chat" v-if="show_notification" ref="scroll_notification">
      <ul class="list-group shadow-lg" id="chat-container">
        <li class="list-group-item active text-center">
          <i class="fas fa-people-carry"></i> Sopoerte
        </li>
        <div id="messages">
          <!-- Mensaje entrante -->

          <span v-for="(item, index) in this.messages" :key="index">
            <div class="text-black text-left" v-if="item.position==1">
              <img class="avatar" :src="item.avatar" />
              <span class="message">{{item.message}}</span>
            </div>

            <!-- Mensaje saliente -->
            <div class="text-black text-right" v-else>
              <span class="message text-right">{{item.message}}</span>
              <img class="avatar" :src="item.avatar" />
            </div>
          </span>

          <div id="init" ref="init"></div>
        </div>

        <li style="list-style:none">
          <input
            type="text"
            class="form-control"
            placeholder="Mensaje"
            autofocus
            v-model="message_input"
            @keypress.enter="sendMessage()"
          />
        </li>
      </ul>
    </div>

    <div>
      <button type="button" class="btn btn-primary btn-carrito" @click="showNotification()">
        <span>
          <i data-placement="top" class="fas fa-comment-dots mt-2 align-middle"></i>
          <span class="badge badge-danger span-carrito">{{messages.length}}</span>
        </span>
      </button>
    </div>
  </div>
</template>




<script>
export default {
  data() {
    return {
      show_notification: true,
      message_input: "",
      messages: [
        {
          avatar:
            "https://pluralsight.imgix.net/paths/path-icons/nodejs-601628d09d.png",
          message: "Mesajes entrantes",
          position: 1
        }
      ]
    };
  },
  methods: {
    sendMessage() {
      this.messages.push({
        message: this.message_input,
        avatar:
          "https://pluralsight.imgix.net/paths/path-icons/nodejs-601628d09d.png",
        position: 2
      });

      // this.$scrollTo(this.$refs.init, 2000, {
      //   el: "#init"
      // });
      // $("#chat").animate(
      //   {
      //     scrollTop: $("#chat").prop("scrollHeight")
      //   },
      //   3
      // );

      // this.$refs.scroll_notification.scrollTop = 10000;

      // this.message_input = "";
    },
    showNotification() {
      this.show_notification = !this.show_notification;
    }
  }
};
</script>

<style lang="css">
#chat {
  display: inline-flex;
  position: fixed;
  bottom: 10%;
  right: 10%;
  z-index: 40000;
  max-width: 200px;
  width: 200px;
}
#scroll-notification {
  max-height: 70vh;
  overflow: scroll !important;
}
.bg-white {
  /* background: white !important; */
}
.btn-carrito {
  position: fixed;
  right: 30px;
  bottom: 60px;
  width: 70px !important;
  height: 70px !important;
  border-radius: 50%;
  z-index: 40000;
}
.btn-carrito i {
  margin-top: 10px !important;
  font-size: 35px !important;
  color: white;
}
/* .btn .badge {
  padding-top: 5px !important;
} */
.span-carrito {
  height: 20px !important;
  width: 30px !important;
  color: white;
  /* border-radius: 100%; */
  padding-top: 5px;
  /* left: -100px; */
}

#messages {
  max-height: 70vh;
  overflow: scroll !important;
  background: white;
}

.outgoing {
  padding: 10px;
  /* background: cyan; */
}
</style>