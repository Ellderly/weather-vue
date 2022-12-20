<template>
  <div class="location">
  <header class="header">
    <ul>
      <li><button @click="(e) => changePage = e.target.innerText">City</button></li>
      <li><button @click="(e) => changePage = e.target.innerText">Favorites</button></li>
    </ul>
  </header>
    <ThisCity v-if="changePage === 'City'"  :weathers="weathers"/>
    <AllCitis v-if="changePage === 'Favorites'"
              :allWeathers="allWeathers"
              @item="itemWeather"
              @deleteItem="deleteItem"
    />
  </div>
</template>

<script>
import {ref} from "vue";
import ThisCity from "@/components/ThisCity.vue";
import AllCitis from "@/components/AllCitis.vue";
export default {
  components: {AllCitis, ThisCity},
  props: {
    allWeathers: {
    type: Array,
    required: true
    },
    weathers: {
      type: Array,
      required: true
    }
  },

  setup(props, context) {

    const changePage = ref('City')

    const itemWeather = (item, country) => {
      context.emit('itemWeather', item, country)
    }
    const deleteItem = (item) => {
      context.emit('deleteItem', item)
    }

    return {changePage, itemWeather,deleteItem}
  }
}
</script>

<style lang="scss" scoped>
.location{
  max-width: 45%;
  width: 100%;
  padding: 50px;
  .header{
    ul{
      margin: 0;
      padding: 0;
      display: flex;
      gap: 30px;
      li button{
        transition: .2s;
        border: 0;
        border-bottom: 1px solid #fff;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        color: #363636;
        background: #fff;
        border-bottom: 2px solid #fff;
        &:hover{
          border-bottom: 2px solid green;
        }
      }
    }
  }
  @media (max-width: 1000px) {
    max-width: 100%;
  }
  @media (max-width: 420px) {
    padding: 20px;
  }
}
</style>