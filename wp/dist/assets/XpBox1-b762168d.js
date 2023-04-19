import { d as defineAsyncComponent, _ as __vitePreload, o as openBlock, b as createBlock, u as unref } from './index-b6dfd5b9.js';

const _sfc_main = {
  __name: 'XpBox1',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-15b4e389.js'),true?["./MyTest-15b4e389.js","./index-b6dfd5b9.js","./index-bf99ff62.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createBlock(unref(MyTest)))
}
}

};

export { _sfc_main as default };
