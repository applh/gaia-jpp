import { d as defineAsyncComponent, _ as __vitePreload, o as openBlock, a as createElementBlock, f as createVNode, u as unref, F as Fragment, e as createBaseVNode } from './index-7fddaa5f.js';

const _hoisted_1 = /*#__PURE__*/createBaseVNode("h1", null, "XpBox3", -1);


const _sfc_main = {
  __name: 'XpBox3',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-17c594b7.js'),true?["./MyTest-17c594b7.js","./index-7fddaa5f.js","./index-bf99ff62.css"]:void 0,import.meta.url)
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
