import { g as _export_sfc, w as withAsyncContext, _ as __vitePreload, c as computed, o as openBlock, a as createElementBlock, e as createBaseVNode, F as Fragment, r as renderList, t as toDisplayString, h as withDirectives, v as vModelText, i as vModelDynamic, u as unref, j as withModifiers, p as pushScopeId, k as popScopeId } from './index-f3f79557.js';

const XpForm_vue_vue_type_style_index_0_scoped_b6c857b0_lang = '';

const _withScopeId = n => (pushScopeId("data-v-b6c857b0"),n=n(),popScopeId(),n);
const _hoisted_1 = /*#__PURE__*/ _withScopeId(() => /*#__PURE__*/createBaseVNode("h3", null, "XpForm", -1));
const _hoisted_2 = ["onSubmit"];
const _hoisted_3 = ["name", "onUpdate:modelValue"];
const _hoisted_4 = ["type", "name", "onUpdate:modelValue"];
const _hoisted_5 = /*#__PURE__*/ _withScopeId(() => /*#__PURE__*/createBaseVNode("button", { type: "submit" }, "Submit", -1));


const _sfc_main = {
  __name: 'XpForm',
  async setup(__props) {

let __temp, __restore;

let data_store = (
  ([__temp,__restore] = withAsyncContext(() => __vitePreload(() => import('./index-f3f79557.js').then(n => n.l),true?["./index-f3f79557.js","./index-d5cd5ee5.css"]:void 0,import.meta.url))),
  __temp = await __temp,
  __restore(),
  __temp
);

computed(() => data_store.default.store);
let forms = computed(() => data_store.default.store.forms.contact ?? {});

function act_submit ($event) {
    console.log('act_submit', $event.target);
}


return (_ctx, _cache) => {
  return (openBlock(), createElementBlock(Fragment, null, [
    _hoisted_1,
    createBaseVNode("form", {
      onSubmit: withModifiers(act_submit, ["prevent"])
    }, [
      (openBlock(true), createElementBlock(Fragment, null, renderList(unref(forms), (inout) => {
        return (openBlock(), createElementBlock("label", null, [
          createBaseVNode("span", null, toDisplayString(inout.label), 1),
          (inout.type === 'textarea')
            ? withDirectives((openBlock(), createElementBlock("textarea", {
                key: 0,
                name: inout.name,
                "onUpdate:modelValue": $event => ((inout.value) = $event),
                cols: "80",
                rows: "10"
              }, null, 8, _hoisted_3)), [
                [vModelText, inout.value]
              ])
            : withDirectives((openBlock(), createElementBlock("input", {
                key: 1,
                type: inout.type,
                name: inout.name,
                "onUpdate:modelValue": $event => ((inout.value) = $event)
              }, null, 8, _hoisted_4)), [
                [vModelDynamic, inout.value]
              ])
        ]))
      }), 256)),
      _hoisted_5
    ], 40, _hoisted_2)
  ], 64))
}
}

};
const XpForm = /*#__PURE__*/_export_sfc(_sfc_main, [['__scopeId',"data-v-b6c857b0"]]);

export { XpForm as default };
