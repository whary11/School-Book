<template>
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
          <div v-if="user.avatar">
            <img :src="user.avatar" class="card-img" :alt="`${user.names} ${user.surnames}`" />
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="card">
        <div class="row no-gutters">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{user.names}} {{user.surnames}}</h5>
              <p
                class="card-text text-muted"
              >Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde dolorem molestias, maxime cum delectus molestiae expedita odit, ex facere cumque nobis quos aspernatur iure provident quidem nemo sit earum at.</p>
              <p class="card-text">
                <small class="text-muted">{{user.birth_date | age}} Años de edad.</small>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import { mapState } from "vuex";
export default {
  computed: {
    ...mapState(["user"])
  }
};
</script>