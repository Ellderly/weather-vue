<template>
  <div class="all-weathers">
    <ul>
      <li class="btnSort">
        <button @click.prevent="sortMax">Max</button>
        <button @click.prevent="sortMin">Min</button>
      </li>
      <li v-for="item in weathers" :key="item.city" @click="testWeather(item)">
        <p>{{item.city}}</p>
        <p>{{item.daily.temperature_2m_max[0]}}</p>
        <p>{{item.daily.temperature_2m_min[0]}}</p>
        <button class="deleteItem" @click.stop="deleteItem(item)"></button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {

  props: {
    weathers: {
      type: Array,
      required: true
    }
  },
  setup(props, context) {

    const testWeather = (item) => {
      context.emit('item', item)
    }
    const deleteItem = (item) => {
      context.emit('deleteItem', item)
    }
        const sortMax = () => {
          props.weathers.sort((a,b) => b.daily.temperature_2m_max[0] - a.daily.temperature_2m_max[0])
        }
        const sortMin = () => {
          props.weathers.sort((a,b) => b.daily.temperature_2m_min[0] - a.daily.temperature_2m_min[0])
        }


    return {testWeather, deleteItem, sortMax, sortMin}
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
      gap: 50px;
      padding: 5px 10px;
      cursor: pointer;
      transition: .2s;
      border-radius: 5px;
      &:hover{
        background: rgba(159, 158, 158, 0.3);
      }
      p{
        flex: 0 0 80px;
      }
      .deleteItem{
        position: relative;
        width: 33px;
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
        gap: 90px;
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
    }
  }
}
</style>