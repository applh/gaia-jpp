import { a as defineAsyncComponent, _ as __vitePreload, o as openBlock, e as createBlock, u as unref } from './index-fbbdd6e6.js';

const _sfc_main = {
  __name: 'XpBox3',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-a340dfcb.js'),true?["./MyTest-a340dfcb.js","./index-fbbdd6e6.js","./index-06122cba.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createBlock(unref(MyTest)))
}
}

};

export { _sfc_main as default };
