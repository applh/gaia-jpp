import { d as defineAsyncComponent, _ as __vitePreload, o as openBlock, a as createElementBlock, f as createVNode, u as unref, F as Fragment, e as createBaseVNode } from './index-f3f79557.js';

const _hoisted_1 = /*#__PURE__*/createBaseVNode("h1", null, "XpBox4", -1);


const _sfc_main = {
  __name: 'XpBox4',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-275dd613.js'),true?["./MyTest-275dd613.js","./index-f3f79557.js","./index-d5cd5ee5.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createElementBlock(Fragment, null, [
    _hoisted_1,
    createVNode(unref(MyTest))
  ], 64))
}
}

};

export { _sfc_main as default };
