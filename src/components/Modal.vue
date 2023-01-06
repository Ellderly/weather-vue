<template>
  <div class="modal" v-if="showModal" @click="closeModal">
    <div @click.stop class="modal__container">
      <h2>Add this city to favorites?</h2>
      <div class="change">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    showModal: {
    type: Boolean,
    default: false
    }
  },
  setup(props, { emit }) {

    const closeModal = (e) => {
      emit('update:showModal', false)
      console.log(e.target)
    }
    return {closeModal}
  }
}
</script>

<style lang="scss" scoped>
.modal{
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100vh;
  background: rgba(0, 0, 0, 0.4);
  position: absolute;
  z-index: 10;
  &__container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 300px;
    height: 150px;
    background: #eeeeee;
    border-radius: 10px;
    h2{
      color: #363636;
      font-size: 20px;
      margin: 0 0 15px 0;
    }
  }
}
</style>