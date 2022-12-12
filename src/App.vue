<template>
  <div class="container">
    <SearchCity :defaultCity="defaultCity" :weathers="weathers" @textProd="textProd"/>
    <Location
        :allWeathers="allWeathers"
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
    const allWeathers = ref([])
    const defaultCity = ref([]);

      const textProd = async (e) => {
      try {
        weathers.value = []
        await axios.get(`https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=${e}&days=4&aqi=no&alerts=no`)
            .then(e => weathers.value.push(e.data))
        allWeathers.value.push(weathers.value)
      } catch (e) {
        alert(e + " " + 'you entered the wrong name, try again in another language')
      }
    }

    onMounted(() => {
          axios.get('https://api.weatherapi.com/v1/forecast.json?key=7651423609bc4c27b00165325221012&q=London&days=4&aqi=no&alerts=no')
          .then(e => weathers.value.push(e.data))
    })

    const itemWeather = (item) => {
      defaultCity.value = []
      defaultCity.value.push(item)
    }

    const deleteItem = (item) => {
      allWeathers.value = allWeathers.value.filter(e => e[0].location.name !== item.location.name)
    }

    return {isOpenModal, weathers, defaultCity, itemWeather, deleteItem, textProd, allWeathers}
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