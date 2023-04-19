import { w as withAsyncContext, _ as __vitePreload, c as computed, d as defineAsyncComponent, o as openBlock, a as createElementBlock, u as unref, b as createBlock, e as createBaseVNode, t as toDisplayString, F as Fragment } from './index-c9832ef1.js';

const _sfc_main = {
  __name: 'XpBox',
  async setup(__props) {

let __temp, __restore;

let data_store = (
  ([__temp,__restore] = withAsyncContext(() => __vitePreload(() => import('./index-c9832ef1.js').then(n => n.m),true?["./index-c9832ef1.js","./index-bf99ff62.css"]:void 0,import.meta.url))),
  __temp = await __temp,
  __restore(),
  __temp
); 

const store = computed(() => data_store.default.store);

const XpBox1 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox1-dad94b5a.js'),true?["./XpBox1-dad94b5a.js","./index-c9832ef1.js","./index-bf99ff62.css"]:void 0,import.meta.url));
const XpBox2 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox2-f751bf48.js'),true?["./XpBox2-f751bf48.js","./index-c9832ef1.js","./index-bf99ff62.css"]:void 0,import.meta.url));
const XpBox3 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox3-7eed6ea7.js'),true?["./XpBox3-7eed6ea7.js","./index-c9832ef1.js","./index-bf99ff62.css"]:void 0,import.meta.url));
const XpBox4 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox4-2653384d.js'),true?["./XpBox4-2653384d.js","./index-c9832ef1.js","./index-bf99ff62.css"]:void 0,import.meta.url));


return (_ctx, _cache) => {
  return (openBlock(), createElementBlock(Fragment, null, [
    (unref(store).width < 800)
      ? (openBlock(), createBlock(unref(XpBox1), { key: 0 }))
      : (unref(store).width < 1200)
        ? (openBlock(), createBlock(unref(XpBox2), { key: 1 }))
        : (unref(store).width < 1600)
          ? (openBlock(), createBlock(unref(XpBox3), { key: 2 }))
          : (openBlock(), createBlock(unref(XpBox4), { key: 3 })),
    createBaseVNode("h3", null, toDisplayString(unref(store).width) + "x" + toDisplayString(unref(store).height), 1)
  ], 64))
}
}

};

export { _sfc_main as default };
