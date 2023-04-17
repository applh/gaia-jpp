import { d as defineAsyncComponent, _ as __vitePreload, o as openBlock, a as createElementBlock, f as createVNode, u as unref, F as Fragment, e as createBaseVNode } from './index-02695ace.js';

const _hoisted_1 = /*#__PURE__*/createBaseVNode("h1", null, "XpBox4", -1);


const _sfc_main = {
  __name: 'XpBox4',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-4753bd0c.js'),true?["./MyTest-4753bd0c.js","./index-02695ace.js","./index-4baabbd4.css"]:void 0,import.meta.url)
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
