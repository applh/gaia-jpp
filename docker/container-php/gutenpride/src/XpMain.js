import { useState, useEffect, useLayoutEffect, useSyncExternalStore } from 'react';
// warning: 'react' and not 'React'

export const XpData = {
    title: 'Gaia',
    products: [
        { title: 'Cabbage', isFruit: false, id: 1 },
        { title: 'Garlic', isFruit: false, id: 2 },
        { title: 'Apple', isFruit: true, id: 3 },
    ],
    counter: 0,
    listeners: [],
    subscribe: (listener) => {
        console.log('subscribe', listener);
        XpData.listeners.push(listener);
        return () => {
            console.log('unsubscribe', listener);
            XpData.listeners = XpData.listeners.filter(l => l !== listener);
        }
    },
    getSnapshot: () => {
        // WARNING: Gutenberg calls this function a lot of times after each update ?!
        console.log('getSnapshot', XpData.counter);
        return XpData.counter;
    },
    emitChange: () => {
        console.log('emitChange', XpData.listeners.length, XpData.counter);
        XpData.listeners.forEach(listener => listener());
    },
    setSnapshot: (counter) => {
        console.log('setSnapshot', counter);
        XpData.counter = counter;
        XpData.emitChange();
    },
}

// WRONG
// const [counter, setCounter] = useState(0);

const listItems = XpData.products.map(product =>
    <li key={product.id} style={{
        color: product.isFruit ? 'red' : 'green'
    }}>
        {product.title}
    </li>
);

export function XpButton2({ counter, onClick }) {
    const [count, setCount] = useState(0);
    const commonCount = useSyncExternalStore(XpData.subscribe, XpData.getSnapshot);

    useEffect(() => {
        console.log('useEffect', count);

        return () => {
            // warning: called before the next useEffect
            console.log('useEffect cleanup', count);
        }

    }, [count]);
    // observer: called each time count changes

    useLayoutEffect(() => {
        console.log('useLayoutEffect', count);

        return () => {
            // warning: called before the next useLayoutEffect
            console.log('useLayoutEffect cleanup', count);
        }

    }, [count]);
    // observer: called each time count changes

    function handleClick() {
        setCount(count + 1);
        XpData.counter++;
        console.log('You clicked me!', count, XpData.counter);
    }

    return (
        <button onClick={onClick}>{counter} / { commonCount } / {XpData.counter}</button>
    )
}

export default {
    title: 'XpMain',
    listItems,
}