import { c as computed, d as data_store, a as defineAsyncComponent, _ as __vitePreload, o as openBlock, b as createElementBlock, u as unref, e as createBlock, f as createBaseVNode, t as toDisplayString, F as Fragment } from './index-e1c3e359.js';

const XpBox_vue_vue_type_style_index_0_lang = '';

const _sfc_main = {
  __name: 'XpBox',
  setup(__props) {

const store = computed(() => data_store.store);

const XpBox1 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox1-827ef8d9.js'),true?["./XpBox1-827ef8d9.js","./index-e1c3e359.js","./index-bf99ff62.css"]:void 0,import.meta.url));
const XpBox2 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox2-4e89297c.js'),true?["./XpBox2-4e89297c.js","./index-e1c3e359.js","./index-bf99ff62.css"]:void 0,import.meta.url));
const XpBox3 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox3-936af2a6.js'),true?["./XpBox3-936af2a6.js","./index-e1c3e359.js","./index-bf99ff62.css"]:void 0,import.meta.url));
const XpBox4 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox4-84ed894a.js'),true?["./XpBox4-84ed894a.js","./index-e1c3e359.js","./index-bf99ff62.css"]:void 0,import.meta.url));


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
