import { a as defineAsyncComponent, _ as __vitePreload, o as openBlock, e as createBlock, u as unref } from './index-af79e453.js';

const _sfc_main = {
  __name: 'XpBox3',
  setup(__props) {

const MyTest = defineAsyncComponent(() => {
  return __vitePreload(() => import('./MyTest-3e350352.js'),true?["./MyTest-3e350352.js","./index-af79e453.js","./index-bf99ff62.css"]:void 0,import.meta.url)
});


return (_ctx, _cache) => {
  return (openBlock(), createBlock(unref(MyTest)))
}
}

};

export { _sfc_main as default };