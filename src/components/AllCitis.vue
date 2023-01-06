<template>
  <div class="all-weathers" >
    <ul v-if="allWeathers.length">
<!--      на данный момент вырезано -->
<!--      <li class="btnSort">-->
<!--        <button @click.prevent="sortMax">Max</button>-->
<!--        <button @click.prevent="sortMin">Min</button>-->
<!--      </li>-->
      <li v-for="item in allWeathers" :key="item" @click="changeWeather(item.location.name, item.location.country)">
        <p>{{item.location.name}}</p>
        <p>{{item.forecast.forecastday[0].day.maxtemp_c}}<sup>o</sup></p>
        <p>{{item.forecast.forecastday[0].day.mintemp_c}}<sup>o</sup></p>
        <button class="deleteItem" @click.stop="deleteItem(item)"></button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

  props: {
    allWeathers: {
      type: Array,
      required: true
    }
  },
  setup(props, context) {

    const changeWeather = (item, country) => {
      context.emit('item', item, country)
    }
    const deleteItem = (item) => {
      context.emit('deleteItem', item)
    }
        // const sortMax = () => {
        //   props.weathers.sort((a,b) => b.daily.temperature_2m_max[0] - a.daily.temperature_2m_max[0])
        // }
        // const sortMin = () => {
        //   props.weathers.sort((a,b) => b.daily.temperature_2m_min[0] - a.daily.temperature_2m_min[0])
        // }
    // add to return sortMax, sortMin
    return {changeWeather, deleteItem}
  }
}
</script>

<style lang="scss" scoped>

.all-weathers{
  ul{
    padding: 0;
    margin: 20px 0 0 0 ;
    li{
      display: flex;
      align-items: center;
      gap: 50px;
      padding: 5px 10px;
      cursor: pointer;
      transition: .2s;
      border-radius: 5px;
      &:hover{
        background: rgba(159, 158, 158, 0.3);
      }
      p{
        flex: 0 0 20%;
      }
      .deleteItem{
        position: relative;
        width: 33px;
        height: 33px;
        padding: 0;
        border: none;
        background: none;
        cursor: pointer;
        &::before,
        &::after{
          content: '';
          position: absolute;
          width: 100%;
          height: 2px;
          background: rgba(70, 70, 70, 0.7);
          top: 50%;
          left: 0;
        }
        &::before{
          transform: rotate(45deg);
        }
        &::after{
          transform: rotate(-45deg);
        }
      }
      &.btnSort{
        margin-left: 120px;
        button{
          padding: 10px 15px;
          font-size: 16px;
          background: none;
          border: none;
          cursor: pointer;
          font-weight: 600;
          transition: .2s;
          border-radius: 5px;
          &:hover{
            background: rgba(211, 211, 211, 0.3);
          }
        }
        &:hover{
          background: none
        }
      }
      @media(max-width: 568px){
        gap: 0;
        width: 100%;
        justify-content: space-between;
      }
      @media (max-width: 400px) {
        .deleteItem{
          width: 27px;
          height: 27px;
        }
        p{
          font-size: 14px;
          sup{
            font-size: 14px;
          }
        }
      }
    }
  }
}

</style>