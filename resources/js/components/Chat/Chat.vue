<template>
  <div>
    <div id="chat" v-if="show_notification">
      <ul class="list-group" id="chat-container">
        <li class="list-group-item active text-center">
          <i class="fas fa-people-carry"></i> Sopoerte
        </li>
        <div id="messages">
          <!-- Mensaje entrante -->
          <div class="text-black outgoing">
            <span class="message">Mensaje entrante</span>
            <img
              class="avatar"
              src="https://pluralsight.imgix.net/paths/path-icons/nodejs-601628d09d.png"
            />
          </div>

          <!-- Mensaje saliente -->
          <div class="text-black text-right">
            <span class="message text-right">Mensaje saliente</span>
            <img
              class="avatar"
              src="https://pluralsight.imgix.net/paths/path-icons/nodejs-601628d09d.png"
            />
          </div>
        </div>

        <li style="list-style:none">
          <input type="text" class="form-control" placeholder="Mensaje" autofocus />
        </li>
      </ul>
    </div>

    <div>
      <button type="button" class="btn btn-primary btn-carrito" @click="showNotification()">
        <span>
          <i data-placement="top" class="fas fa-comment-dots mt-2 align-middle"></i>
          <span class="badge badge-danger span-carrito">4</span>
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
      messages: [
        {
          message: "Mesajes entrantes"
        }
      ]
    };
  },
  methods: {
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
  max-width: 400px;
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