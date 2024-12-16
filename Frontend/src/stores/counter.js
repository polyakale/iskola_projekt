import { defineStore } from "pinia"

export const useCounterStore = defineStore('counter', {
    state: () => ({
        counter: 0,
        desiredLength: 3
    }),
    getters: {
        paddedCount: (state) => {
            return state.counter.toString().padStart(state.desiredLength, '0');
        }
    },
    actions: {
        doubleCount() {
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
