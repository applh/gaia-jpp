import { n as isRef, Q as toRefs$1, a7 as customRef, u as unref, g as getCurrentScope, h as onScopeDispose } from './index-fbbdd6e6.js';

function tryOnScopeDispose(fn) {
  if (getCurrentScope()) {
    onScopeDispose(fn);
    return true;
  }
  return false;
}

function toValue(r) {
  return typeof r === "function" ? r() : unref(r);
}

const isClient = typeof window !== "undefined";
const noop = () => {
};

var __defProp$9 = Object.defineProperty;
var __defProps$7 = Object.defineProperties;
var __getOwnPropDescs$7 = Object.getOwnPropertyDescriptors;
var __getOwnPropSymbols$b = Object.getOwnPropertySymbols;
var __hasOwnProp$b = Object.prototype.hasOwnProperty;
var __propIsEnum$b = Object.prototype.propertyIsEnumerable;
var __defNormalProp$9 = (obj, key, value) => key in obj ? __defProp$9(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
var __spreadValues$9 = (a, b) => {
  for (var prop in b || (b = {}))
    if (__hasOwnProp$b.call(b, prop))
      __defNormalProp$9(a, prop, b[prop]);
  if (__getOwnPropSymbols$b)
    for (var prop of __getOwnPropSymbols$b(b)) {
      if (__propIsEnum$b.call(b, prop))
        __defNormalProp$9(a, prop, b[prop]);
    }
  return a;
};
var __spreadProps$7 = (a, b) => __defProps$7(a, __getOwnPropDescs$7(b));
function toRefs(objectRef) {
  if (!isRef(objectRef))
    return toRefs$1(objectRef);
  const result = Array.isArray(objectRef.value) ? new Array(objectRef.value.length) : {};
  for (const key in objectRef.value) {
    result[key] = customRef(() => ({
      get() {
        return objectRef.value[key];
      },
      set(v) {
        if (Array.isArray(objectRef.value)) {
          const copy = [...objectRef.value];
          copy[key] = v;
          objectRef.value = copy;
        } else {
          const newObject = __spreadProps$7(__spreadValues$9({}, objectRef.value), { [key]: v });
          Object.setPrototypeOf(newObject, objectRef.value);
          objectRef.value = newObject;
        }
      }
    }));
  }
  return result;
}

export { toRefs as a, tryOnScopeDispose as b, isClient as i, noop as n, toValue as t };
