import { a as defineAsyncComponent, _ as __vitePreload, o as openBlock, e as createBlock, u as unref } from './index-1be2dd73.js';

const _sfc_main = {
  __name: 'XpBox2',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-8deaaadf.js'),true?["./MyTest-8deaaadf.js","./index-1be2dd73.js","./index-bf99ff62.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createBlock(unref(MyTest)))
}
}

};

export { _sfc_main as default };