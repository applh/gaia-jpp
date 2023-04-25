import { a as defineAsyncComponent, _ as __vitePreload, o as openBlock, e as createBlock, u as unref } from './index-ec341aa0.js';

const _sfc_main = {
  __name: 'XpBox4',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-776d04b5.js'),true?["./MyTest-776d04b5.js","./index-ec341aa0.js","./index-6ef1c84b.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createBlock(unref(MyTest)))
}
}

};

export { _sfc_main as default };
