import { a as defineAsyncComponent, _ as __vitePreload, o as openBlock, e as createBlock, u as unref } from './index-e1c3e359.js';

const _sfc_main = {
  __name: 'XpBox4',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-5f5cfd3d.js'),true?["./MyTest-5f5cfd3d.js","./index-e1c3e359.js","./index-bf99ff62.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createBlock(unref(MyTest)))
}
}

};

export { _sfc_main as default };
