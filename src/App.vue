<template>
  <div class="container">
    <SearchCity @onsubmitsForm="onsubmitForm" :defaultCity="defaultCity" />
    <Location
        :defaultCity="defaultCity"
        :weathers="weathers"
        @itemWeather="itemWeather"
        @deleteItem="deleteItem"

    />
  </div>
</template>

<script>

import SearchCity from "@/components/Search-City.vue";
import Location from "@/components/Location.vue";
import {onMounted, ref} from "vue";
import axios from "axios";

export default {
  components: {Location, SearchCity},
  setup() {
    let isOpenModal = ref(false)
    const weathers = ref([]);
    const defaultCity = ref([]);

    onMounted(() => {
      axios.get('https://63926a80b750c8d178ddf6f9.mockapi.io/city')
          .then(e => weathers.value.push(...e.data))
      axios.get('https://63926a80b750c8d178ddf6f9.mockapi.io/city?search=kyiv')
          .then(e => defaultCity.value.push(...e.data))
    })

    const onsubmitForm = (inputCity) => {
      const newCity = inputCity
    }
    const itemWeather = (item) => {
      defaultCity.value = []
      defaultCity.value.push(item)
    }

    const deleteItem = (item) => {
      weathers.value = weathers.value.filter(e => e.city !== item.city)
    }
    return {onsubmitForm, isOpenModal, weathers, defaultCity, itemWeather, deleteItem}
  }
}
</script>

<style lang="scss">


                             *{
                               box-sizing: border-box;
                               outline: none;



                               font-family: Inter, Avenir, Helvetica, Arial, sans-serif;
                               font-size: 16px;
                               line-height: 24px;
                               font-weight: 400;

                               font-synthesis: none;
                               text-rendering: optimizeLegibility;
                               -webkit-font-smoothing: antialiased;
                               -moz-osx-font-smoothing: grayscale;
                               -webkit-text-size-adjust: 100%;
                             }
a {
  font-weight: 500;
  text-decoration: inherit;
}

body {
  margin: 0;
  padding: 0;
}
ul{
  list-style: none;
}



.container{
  display: flex;
}
</style>