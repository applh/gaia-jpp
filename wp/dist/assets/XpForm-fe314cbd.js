import { w as withAsyncContext, _ as __vitePreload, c as computed, u as unref, o as openBlock, b as createElementBlock, e as createBlock, g as withCtx, h as createTextVNode, t as toDisplayString, r as resolveDynamicComponent, F as Fragment, i as renderList, f as createBaseVNode, j as withDirectives, v as vModelText, k as vModelDynamic, l as withModifiers, m as createCommentVNode } from './index-34d38590.js';
import { _ as _export_sfc } from './_plugin-vue_export-helper-c4c0bc37.js';

const XpForm_vue_vue_type_style_index_0_scoped_18f2f082_lang = '';

const _hoisted_1 = ["onSubmit"];
const _hoisted_2 = ["name", "onUpdate:modelValue"];
const _hoisted_3 = ["type", "name", "onUpdate:modelValue", "required"];
const _hoisted_4 = { type: "submit" };
const _hoisted_5 = { class: "feedback" };

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
  ([__temp,__restore] = withAsyncContext(() => __vitePreload(() => import('./index-34d38590.js').then(n => n.G),true?["./index-34d38590.js","./index-2e2dcb74.css"]:void 0,import.meta.url))),
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
        (openBlock(), createBlock(resolveDynamicComponent(unref(form)?.tags?.title ?? 'em'), { class: "title" }, {
          default: withCtx(() => [
            createTextVNode(toDisplayString(unref(form).labels.title), 1)
          ]),
          _: 1
        })),
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
                }, null, 8, _hoisted_2)), [
                  [vModelText, fin.value]
                ])
              : withDirectives((openBlock(), createElementBlock("input", {
                  key: 1,
                  type: fin.type,
                  name: fin.name,
                  "onUpdate:modelValue": $event => ((fin.value) = $event),
                  required: fin.required
                }, null, 8, _hoisted_3)), [
                  [vModelDynamic, fin.value]
                ])
          ]))
        }), 256)),
        createBaseVNode("button", _hoisted_4, toDisplayString(unref(form).labels.submit), 1),
        createBaseVNode("div", _hoisted_5, toDisplayString(unref(form).labels.feedback), 1)
      ], 40, _hoisted_1))
    : createCommentVNode("", true)
}
}

};
const XpForm = /*#__PURE__*/_export_sfc(_sfc_main, [['__scopeId',"data-v-18f2f082"]]);

export { XpForm as default };
