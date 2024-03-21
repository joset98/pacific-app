<template>
  <div class="bgc-white bd p-20">
    <div class="mB-10 w-100 pax-6px">
      <slot name="head">
        <h4 v-if="title" class="c-grey-900">
          {{ title }}
        </h4>
      </slot>
    </div>

    <div v-if="data && data.length > 0"  class="scroll-x">
      <div :class="['tcontext']">
        <div v-if="titles" class="thead">
          <div
            :style="[rows[index].style, roundedTopLeft(index), roundedTopRight(index, titles.length)]"
            :class="[rows[index].classList, {'bordered': bordered}, classHead]"
            v-for="(title, index) in titles" :key="index"
          >
            {{title}}
          </div>
        </div>
        <div class="tbody">
          <div :class="[{'striped': striped}]" v-for="(item, index) in data" :key="index">
            <div
              :style="[row.style, roundedBottomLeft(indexRow, index, data.length), roundedBottomRight(indexRow, rows.length, index, data.length)]"
              :class="[row.classList, {'bordered': bordered}, (row.typeBoolean) ? (item[row.value]) ? row.typeBoolean[0].classList : row.typeBoolean[1].classList : '']"
              v-for="(row, indexRow) in rows" :key="indexRow"
            >
              <span v-if="!row.slot">{{getItem(item, row)}}</span>
              <slot v-else :name="row.value" v-bind:item="item"></slot>

            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="noData">
      <h3 class="text-center c-grey-900">Sin resultados</h3>
    </div>

    <div class="mT-10 w-100 pax-6px">
      <slot name="footer"/>
    </div>
  </div>
</template>

<script>
export default {
  name: 'table-general',
  methods:{
    // get value item
    getItem(item, row){
      if(row.typeBoolean){
        if(item[row.value]) return row.typeBoolean[0].label;
        else return row.typeBoolean[1].label;
      }

      return item[row.value];
    },

    // Functions from border radius
    roundedTopLeft(key){ if(key == 0) return{ borderTopLeftRadius: this.rounded } },
    roundedTopRight(key, last){ if(key == last - 1) return{ borderTopRightRadius: this.rounded } },
    roundedBottomLeft(keyRow, key, last){ if(keyRow == 0 && key == last - 1) return{ borderBottomLeftRadius: this.rounded } },
    roundedBottomRight(keyRow, lastRow, key, last){ if(keyRow == lastRow - 1 && key == last - 1) return{ borderBottomRightRadius: this.rounded } },
  },
  computed:{
    data:{
      get(){ return this.value; },
      set(val){ this.$emit('input', val); }
    },
  },
  props:{
    value:{
      default: null
    },
    title:{
      type: String,
      default: null
    },
    classHead:{
      type: String,
      default: ''
    },
    titles:{
      type: Array,
      default: null
    },
    rows:{
      type: [Array, Object],
      default: null
    },
    bordered:{
      type: Boolean,
      default: false
    },
    rounded:{
      type: [String, Array],
      default: '0px'
    },
    striped:{
      type: Boolean,
      default: false
    }
  }
}
</script>


<style scope lang="scss">
  .scroll-x{
    overflow-x: auto;
    width: 100%;
  }
  .pax-6px{
    padding: 0px 6px;
  }
  .bordered{
    border: 1px solid rgba(0,0,0,.0625);
  }
  .striped:nth-child(even) {
    background-color: #f2f2f2;
  }
  .noData{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    min-height: 50vh;
  }
  .tcontext{
    min-width: 767px;
    .thead{
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      padding: 0px 6px;
      div{
        flex: 1;
        overflow-wrap: anywhere;
        padding: 10px 8px;
        font-weight: bold;
        border-bottom: 1px solid rgba(0,0,0,.0625);
      }
    }
    .tbody{
      overflow-y: scroll;
      box-sizing: border-box;
      height: 100%;
      max-height: 40vh;
      padding-left: 6px;
      div {
        display: flex;
        flex-wrap: wrap;
        div{
          flex: 1;
          align-items: center;
          overflow-wrap: anywhere;
          padding: 10px 8px;
          border-bottom: 1px solid rgba(0,0,0,.0625);
        }
      }
    }
  }
</style>
