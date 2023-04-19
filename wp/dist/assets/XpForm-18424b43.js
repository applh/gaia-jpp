import { g as _export_sfc, w as withAsyncContext, _ as __vitePreload, c as computed, u as unref, o as openBlock, a as createElementBlock, F as Fragment, r as renderList, e as createBaseVNode, t as toDisplayString, h as withDirectives, v as vModelText, i as vModelDynamic, j as withModifiers, k as createCommentVNode, p as pushScopeId, l as popScopeId } from './index-c9832ef1.js';

const XpForm_vue_vue_type_style_index_0_scoped_25cec0eb_lang = '';

const _withScopeId = n => (pushScopeId("data-v-25cec0eb"),n=n(),popScopeId(),n);
const _hoisted_1 = ["onSubmit"];
const _hoisted_2 = /*#__PURE__*/ _withScopeId(() => /*#__PURE__*/createBaseVNode("em", null, "XpForm", -1));
const _hoisted_3 = ["name", "onUpdate:modelValue"];
const _hoisted_4 = ["type", "name", "onUpdate:modelValue"];
const _hoisted_5 = { type: "submit" };

// add prop name with default value contact

const _sfc_main = {
  __name: 'XpForm',
  props: {
    name: {
        type: String,
        default: 'contact'
    }
},
  async setup(__props) {

let __temp, __restore;

const props = __props;



let data_store = (
  ([__temp,__restore] = withAsyncContext(() => __vitePreload(() => import('./index-c9832ef1.js').then(n => n.m),true?["./index-c9832ef1.js","./index-bf99ff62.css"]:void 0,import.meta.url))),
  __temp = await __temp,
  __restore(),
  __temp
);

computed(() => data_store.default.store);
let form = computed(() => data_store.default.store.forms[props.name ?? 'contact'] ?? null);

function act_submit ($event) {
    console.log('act_submit', $event.target);
}


return (_ctx, _cache) => {
  return (unref(form))
    ? (openBlock(), createElementBlock("form", {
        key: 0,
        onSubmit: withModifiers(act_submit, ["prevent"])
      }, [
        _hoisted_2,
        (openBlock(true), createElementBlock(Fragment, null, renderList(unref(form).inputs, (fin) => {
          return (openBlock(), createElementBlock("label", null, [
            createBaseVNode("span", null, toDisplayString(fin.label), 1),
            (fin.type === 'textarea')
              ? withDirectives((openBlock(), createElementBlock("textarea", {
                  key: 0,
                  name: fin.name,
                  "onUpdate:modelValue": $event => ((fin.value) = $event),
                  cols: "80",
                  rows: "10"
                }, null, 8, _hoisted_3)), [
                  [vModelText, fin.value]
                ])
              : withDirectives((openBlock(), createElementBlock("input", {
                  key: 1,
                  type: fin.type,
                  name: fin.name,
                  "onUpdate:modelValue": $event => ((fin.value) = $event)
                }, null, 8, _hoisted_4)), [
                  [vModelDynamic, fin.value]
                ])
          ]))
        }), 256)),
        createBaseVNode("button", _hoisted_5, toDisplayString(unref(form).labels.submit), 1)
      ], 40, _hoisted_1))
    : createCommentVNode("", true)
}
}

};
const XpForm = /*#__PURE__*/_export_sfc(_sfc_main, [['__scopeId',"data-v-25cec0eb"]]);

export { XpForm as default };
