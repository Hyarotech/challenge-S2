export default async () => {
    async function onMount() {
        console.log("Mounted");
    }
   async function onUnmount() {
        console.log("Unmounted");
    }
    async function useEffect(callback) {
        callback();
    }
    function useState(initialState) {
        let state = initialState;
        function setState(newState) {
            state = newState;
        }
        return [state, setState];
    }
    return {
        onMount,
        onUnmount,
        useEffect,
        useState
    }
}