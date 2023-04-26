import { c as computed, d as data_store, a as defineAsyncComponent, _ as __vitePreload, o as openBlock, b as createElementBlock, u as unref, e as createBlock, f as createBaseVNode, t as toDisplayString, F as Fragment } from './index-fbbdd6e6.js';

/* unplugin-vue-components disabled */const XpBox_vue_vue_type_style_index_0_lang = '';

const _sfc_main = {
  __name: 'XpBox',
  setup(__props) {

const store = computed(() => data_store.store);

const XpBox1 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox1-20993d14.js'),true?["./XpBox1-20993d14.js","./index-fbbdd6e6.js","./index-06122cba.css"]:void 0,import.meta.url));
const XpBox2 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox2-c3984f31.js'),true?["./XpBox2-c3984f31.js","./index-fbbdd6e6.js","./index-06122cba.css"]:void 0,import.meta.url));
const XpBox3 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox3-69a46578.js'),true?["./XpBox3-69a46578.js","./index-fbbdd6e6.js","./index-06122cba.css"]:void 0,import.meta.url));
const XpBox4 = defineAsyncComponent(() => __vitePreload(() => import('./XpBox4-86e9bc4d.js'),true?["./XpBox4-86e9bc4d.js","./index-fbbdd6e6.js","./index-06122cba.css"]:void 0,import.meta.url));


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
