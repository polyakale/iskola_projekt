import { defineStore } from 'pinia'

export const useCounterStore = defineStore('counter', {
  //Ezek a változók
  state: () => ({
    counter: 1, //001
    desiredLength: 3
  }),
  //valamilyen formában visszaadja
  getters: {
    paddedCount: (state) => {
      return state.counter.toString().padStart(state.desiredLength, '0');
    }
  },
  //csinál vele valamit
  actions: {
    doubleCount(){
      this.counter * 2;
    },
    increment() {
      this.counter++;
    },
    decrement() {
      this.counter--;
    }
  }
});
