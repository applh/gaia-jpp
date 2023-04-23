import { q as ref, z as watch, o as openBlock, b as createElementBlock, f as createBaseVNode, F as Fragment, i as renderList, A as normalizeClass, u as unref, l as withModifiers, t as toDisplayString, j as withDirectives, v as vModelText, y as isRef, s as normalizeStyle } from './index-34d38590.js';
import { a as unrefElement, t as tryOnScopeDispose, c as createEventHook, b as toRefs } from './index-da9c79b5.js';
import { _ as _export_sfc } from './_plugin-vue_export-helper-c4c0bc37.js';

function $(e,t,u,x=h=>h){return e*x(.5-t*(.5-u))}function se(e){return [-e[0],-e[1]]}function l(e,t){return [e[0]+t[0],e[1]+t[1]]}function a(e,t){return [e[0]-t[0],e[1]-t[1]]}function b(e,t){return [e[0]*t,e[1]*t]}function he(e,t){return [e[0]/t,e[1]/t]}function R(e){return [e[1],-e[0]]}function B(e,t){return e[0]*t[0]+e[1]*t[1]}function ue(e,t){return e[0]===t[0]&&e[1]===t[1]}function ge(e){return Math.hypot(e[0],e[1])}function de(e){return e[0]*e[0]+e[1]*e[1]}function A(e,t){return de(a(e,t))}function G(e){return he(e,ge(e))}function ie(e,t){return Math.hypot(e[1]-t[1],e[0]-t[0])}function L(e,t,u){let x=Math.sin(u),h=Math.cos(u),y=e[0]-t[0],n=e[1]-t[1],f=y*h-n*x,d=y*x+n*h;return [f+t[0],d+t[1]]}function K(e,t,u){return l(e,b(a(t,e),u))}function ee(e,t,u){return l(e,b(t,u))}var{min:C,PI:xe}=Math,pe=.275,V=xe+1e-4;function ce(e,t={}){let{size:u=16,smoothing:x=.5,thinning:h=.5,simulatePressure:y=!0,easing:n=r=>r,start:f={},end:d={},last:D=!1}=t,{cap:S=!0,easing:j=r=>r*(2-r)}=f,{cap:q=!0,easing:c=r=>--r*r*r+1}=d;if(e.length===0||u<=0)return [];let p=e[e.length-1].runningLength,g=f.taper===!1?0:f.taper===!0?Math.max(u,p):f.taper,T=d.taper===!1?0:d.taper===!0?Math.max(u,p):d.taper,te=Math.pow(u*x,2),_=[],M=[],H=e.slice(0,10).reduce((r,i)=>{let o=i.pressure;if(y){let s=C(1,i.distance/u),W=C(1,1-s);o=C(1,r+(W-r)*(s*pe));}return (r+o)/2},e[0].pressure),m=$(u,h,e[e.length-1].pressure,n),U,X=e[0].vector,z=e[0].point,F=z,O=z,E=F,J=!1;for(let r=0;r<e.length;r++){let{pressure:i}=e[r],{point:o,vector:s,distance:W,runningLength:I}=e[r];if(r<e.length-1&&p-I<3)continue;if(h){if(y){let v=C(1,W/u),Z=C(1,1-v);i=C(1,H+(Z-H)*(v*pe));}m=$(u,h,i,n);}else m=u/2;U===void 0&&(U=m);let le=I<g?j(I/g):1,fe=p-I<T?c((p-I)/T):1;m=Math.max(.01,m*Math.min(le,fe));let re=(r<e.length-1?e[r+1]:e[r]).vector,Y=r<e.length-1?B(s,re):1,be=B(s,X)<0&&!J,ne=Y!==null&&Y<0;if(be||ne){let v=b(R(X),m);for(let Z=1/13,w=0;w<=1;w+=Z)O=L(a(o,v),o,V*w),_.push(O),E=L(l(o,v),o,V*-w),M.push(E);z=O,F=E,ne&&(J=!0);continue}if(J=!1,r===e.length-1){let v=b(R(s),m);_.push(a(o,v)),M.push(l(o,v));continue}let oe=b(R(K(re,s,Y)),m);O=a(o,oe),(r<=1||A(z,O)>te)&&(_.push(O),z=O),E=l(o,oe),(r<=1||A(F,E)>te)&&(M.push(E),F=E),H=i,X=s;}let P=e[0].point.slice(0,2),k=e.length>1?e[e.length-1].point.slice(0,2):l(e[0].point,[1,1]),Q=[],N=[];if(e.length===1){if(!(g||T)||D){let r=ee(P,G(R(a(P,k))),-(U||m)),i=[];for(let o=1/13,s=o;s<=1;s+=o)i.push(L(r,P,V*2*s));return i}}else {if(!(g||T&&e.length===1))if(S)for(let i=1/13,o=i;o<=1;o+=i){let s=L(M[0],P,V*o);Q.push(s);}else {let i=a(_[0],M[0]),o=b(i,.5),s=b(i,.51);Q.push(a(P,o),a(P,s),l(P,s),l(P,o));}let r=R(se(e[e.length-1].vector));if(T||g&&e.length===1)N.push(k);else if(q){let i=ee(k,r,m);for(let o=1/29,s=o;s<1;s+=o)N.push(L(i,k,V*3*s));}else N.push(l(k,b(r,m)),l(k,b(r,m*.99)),a(k,b(r,m*.99)),a(k,b(r,m)));}return _.concat(N,M.reverse(),Q)}function me(e,t={}){var q;let{streamline:u=.5,size:x=16,last:h=!1}=t;if(e.length===0)return [];let y=.15+(1-u)*.85,n=Array.isArray(e[0])?e:e.map(({x:c,y:p,pressure:g=.5})=>[c,p,g]);if(n.length===2){let c=n[1];n=n.slice(0,-1);for(let p=1;p<5;p++)n.push(K(n[0],c,p/4));}n.length===1&&(n=[...n,[...l(n[0],[1,1]),...n[0].slice(2)]]);let f=[{point:[n[0][0],n[0][1]],pressure:n[0][2]>=0?n[0][2]:.25,vector:[1,1],distance:0,runningLength:0}],d=!1,D=0,S=f[0],j=n.length-1;for(let c=1;c<n.length;c++){let p=h&&c===j?n[c].slice(0,2):K(S.point,n[c],y);if(ue(S.point,p))continue;let g=ie(p,S.point);if(D+=g,c<j&&!d){if(D<x)continue;d=!0;}S={point:p,pressure:n[c][2]>=0?n[c][2]:.5,vector:G(a(S.point,p)),distance:g,runningLength:D},f.push(S);}return f[0].vector=((q=f[1])==null?void 0:q.vector)||[0,0],f}function ae(e,t={}){return ce(me(e,t),t)}

// ../../node_modules/.pnpm/nanoevents@7.0.1/node_modules/nanoevents/index.js
var createNanoEvents = () => ({
  events: {},
  emit(event, ...args) {
    let callbacks = this.events[event] || [];
    for (let i = 0, length = callbacks.length; i < length; i++) {
      callbacks[i](...args);
    }
  },
  on(event, cb) {
    var _a;
    ((_a = this.events[event]) == null ? void 0 : _a.push(cb)) || (this.events[event] = [cb]);
    return () => {
      var _a2;
      this.events[event] = (_a2 = this.events[event]) == null ? void 0 : _a2.filter((i) => cb !== i);
    };
  }
});

// src/utils/index.ts
function numSort(a, b) {
  return a - b;
}
function getSymbol(a) {
  if (a < 0)
    return -1;
  return 1;
}
function splitNum(a) {
  return [Math.abs(a), getSymbol(a)];
}
function guid() {
  const S4 = () => ((1 + Math.random()) * 65536 | 0).toString(16).substring(1);
  return `${S4() + S4()}-${S4()}-${S4()}-${S4()}-${S4()}${S4()}${S4()}`;
}
var DECIMAL = 2;
var D = DECIMAL;

// src/models/base.ts
var BaseModel = class {
  constructor(drauu) {
    this.drauu = drauu;
    this.event = void 0;
    this.point = void 0;
    this.start = void 0;
    this.el = null;
  }
  onSelected(el) {
  }
  onUnselected() {
  }
  onStart(point) {
    return void 0;
  }
  onMove(point) {
    return false;
  }
  onEnd(point) {
    return void 0;
  }
  get brush() {
    return this.drauu.brush;
  }
  get shiftPressed() {
    return this.drauu.shiftPressed;
  }
  get altPressed() {
    return this.drauu.altPressed;
  }
  get svgElement() {
    return this.drauu.el;
  }
  getMousePosition(event) {
    var _a;
    const el = this.drauu.el;
    const scale = this.drauu.options.coordinateScale ?? 1;
    if (this.drauu.options.coordinateTransform === false) {
      const rect = this.drauu.el.getBoundingClientRect();
      return {
        x: (event.pageX - rect.left) * scale,
        y: (event.pageY - rect.top) * scale,
        pressure: event.pressure
      };
    } else {
      const point = this.drauu.svgPoint;
      point.x = event.clientX;
      point.y = event.clientY;
      const loc = point.matrixTransform((_a = el.getScreenCTM()) == null ? void 0 : _a.inverse());
      return {
        x: loc.x * scale,
        y: loc.y * scale,
        pressure: event.pressure
      };
    }
  }
  createElement(name, overrides) {
    const el = document.createElementNS("http://www.w3.org/2000/svg", name);
    const brush = overrides ? {
      ...this.brush,
      ...overrides
    } : this.brush;
    el.setAttribute("fill", brush.fill ?? "transparent");
    el.setAttribute("stroke", brush.color);
    el.setAttribute("stroke-width", brush.size.toString());
    el.setAttribute("stroke-linecap", "round");
    if (brush.dasharray)
      el.setAttribute("stroke-dasharray", brush.dasharray);
    return el;
  }
  attr(name, value) {
    this.el.setAttribute(name, typeof value === "string" ? value : value.toFixed(D));
  }
  _setEvent(event) {
    this.event = event;
    this.point = this.getMousePosition(event);
  }
  _eventDown(event) {
    this._setEvent(event);
    this.start = this.point;
    return this.onStart(this.point);
  }
  _eventMove(event) {
    this._setEvent(event);
    return this.onMove(this.point);
  }
  _eventUp(event) {
    this._setEvent(event);
    return this.onEnd(this.point);
  }
};

// src/models/stylus.ts
var StylusModel = class extends BaseModel {
  constructor() {
    super(...arguments);
    this.points = [];
  }
  onStart(point) {
    this.el = document.createElementNS("http://www.w3.org/2000/svg", "path");
    this.points = [point];
    this.attr("fill", this.brush.color);
    this.attr("d", this.getSvgData(this.points));
    return this.el;
  }
  onMove(point) {
    if (!this.el)
      this.onStart(point);
    if (this.points[this.points.length - 1] !== point)
      this.points.push(point);
    this.attr("d", this.getSvgData(this.points));
    return true;
  }
  onEnd() {
    const path = this.el;
    this.el = null;
    if (!path)
      return false;
    return true;
  }
  getSvgData(points) {
    const stroke = ae(points, {
      size: this.brush.size * 2,
      thinning: 0.9,
      simulatePressure: false,
      start: {
        taper: 5
      },
      end: {
        taper: 5
      },
      ...this.brush.stylusOptions
    });
    if (!stroke.length)
      return "";
    const d = stroke.reduce(
      (acc, [x0, y0], i, arr) => {
        const [x1, y1] = arr[(i + 1) % arr.length];
        acc.push(x0, y0, (x0 + x1) / 2, (y0 + y1) / 2);
        return acc;
      },
      ["M", ...stroke[0], "Q"]
    );
    d.push("Z");
    return d.map((i) => typeof i === "number" ? i.toFixed(2) : i).join(" ");
  }
};

// src/models/ellipse.ts
var EllipseModel = class extends BaseModel {
  onStart(point) {
    this.el = this.createElement("ellipse");
    this.attr("cx", point.x);
    this.attr("cy", point.y);
    return this.el;
  }
  onMove(point) {
    if (!this.el || !this.start)
      return false;
    let [dx, sx] = splitNum(point.x - this.start.x);
    let [dy, sy] = splitNum(point.y - this.start.y);
    if (this.shiftPressed) {
      const d = Math.min(dx, dy);
      dx = d;
      dy = d;
    }
    if (this.altPressed) {
      this.attr("cx", this.start.x);
      this.attr("cy", this.start.y);
      this.attr("rx", dx);
      this.attr("ry", dy);
    } else {
      const [x1, x2] = [this.start.x, this.start.x + dx * sx].sort(numSort);
      const [y1, y2] = [this.start.y, this.start.y + dy * sy].sort(numSort);
      this.attr("cx", (x1 + x2) / 2);
      this.attr("cy", (y1 + y2) / 2);
      this.attr("rx", (x2 - x1) / 2);
      this.attr("ry", (y2 - y1) / 2);
    }
    return true;
  }
  onEnd() {
    const path = this.el;
    this.el = null;
    if (!path)
      return false;
    if (!path.getTotalLength())
      return false;
    return true;
  }
};

// src/utils/dom.ts
function createArrowHead(id, fill) {
  const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
  const marker = document.createElementNS("http://www.w3.org/2000/svg", "marker");
  const head = document.createElementNS("http://www.w3.org/2000/svg", "path");
  head.setAttribute("fill", fill);
  marker.setAttribute("id", id);
  marker.setAttribute("viewBox", "0 -5 10 10");
  marker.setAttribute("refX", "5");
  marker.setAttribute("refY", "0");
  marker.setAttribute("markerWidth", "4");
  marker.setAttribute("markerHeight", "4");
  marker.setAttribute("orient", "auto");
  head.setAttribute("d", "M0,-5L10,0L0,5");
  marker.appendChild(head);
  defs.appendChild(marker);
  return defs;
}

// src/models/line.ts
var LineModel = class extends BaseModel {
  onStart(point) {
    this.el = this.createElement("line", { fill: "transparent" });
    this.attr("x1", point.x);
    this.attr("y1", point.y);
    this.attr("x2", point.x);
    this.attr("y2", point.y);
    if (this.brush.arrowEnd) {
      const id = guid();
      const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
      g.append(createArrowHead(id, this.brush.color));
      g.append(this.el);
      this.attr("marker-end", `url(#${id})`);
      return g;
    }
    return this.el;
  }
  onMove(point) {
    if (!this.el)
      return false;
    let { x, y } = point;
    if (this.shiftPressed) {
      const dx = point.x - this.start.x;
      const dy = point.y - this.start.y;
      if (dy !== 0) {
        let slope = dx / dy;
        slope = Math.round(slope);
        if (Math.abs(slope) <= 1) {
          x = this.start.x + dy * slope;
          y = this.start.y + dy;
        } else {
          x = this.start.x + dx;
          y = this.start.y;
        }
      }
    }
    if (this.altPressed) {
      this.attr("x1", this.start.x * 2 - x);
      this.attr("y1", this.start.y * 2 - y);
      this.attr("x2", x);
      this.attr("y2", y);
    } else {
      this.attr("x1", this.start.x);
      this.attr("y1", this.start.y);
      this.attr("x2", x);
      this.attr("y2", y);
    }
    return true;
  }
  onEnd() {
    const path = this.el;
    this.el = null;
    if (!path)
      return false;
    if (path.getTotalLength() < 5)
      return false;
    return true;
  }
};

// src/models/rect.ts
var RectModel = class extends BaseModel {
  onStart(point) {
    this.el = this.createElement("rect");
    if (this.brush.cornerRadius) {
      this.attr("rx", this.brush.cornerRadius);
      this.attr("ry", this.brush.cornerRadius);
    }
    this.attr("x", point.x);
    this.attr("y", point.y);
    return this.el;
  }
  onMove(point) {
    if (!this.el || !this.start)
      return false;
    let [dx, sx] = splitNum(point.x - this.start.x);
    let [dy, sy] = splitNum(point.y - this.start.y);
    if (this.shiftPressed) {
      const d = Math.min(dx, dy);
      dx = d;
      dy = d;
    }
    if (this.altPressed) {
      this.attr("x", this.start.x - dx);
      this.attr("y", this.start.y - dy);
      this.attr("width", dx * 2);
      this.attr("height", dy * 2);
    } else {
      const [x1, x2] = [this.start.x, this.start.x + dx * sx].sort(numSort);
      const [y1, y2] = [this.start.y, this.start.y + dy * sy].sort(numSort);
      this.attr("x", x1);
      this.attr("y", y1);
      this.attr("width", x2 - x1);
      this.attr("height", y2 - y1);
    }
    return true;
  }
  onEnd() {
    const path = this.el;
    this.el = null;
    if (!path)
      return false;
    if (!path.getTotalLength())
      return false;
    return true;
  }
};

// src/utils/simplify.ts
function getSqDist(p1, p2) {
  const dx = p1.x - p2.x;
  const dy = p1.y - p2.y;
  return dx * dx + dy * dy;
}
function getSqSegDist(p, p1, p2) {
  let x = p1.x;
  let y = p1.y;
  let dx = p2.x - x;
  let dy = p2.y - y;
  if (dx !== 0 || dy !== 0) {
    const t = ((p.x - x) * dx + (p.y - y) * dy) / (dx * dx + dy * dy);
    if (t > 1) {
      x = p2.x;
      y = p2.y;
    } else if (t > 0) {
      x += dx * t;
      y += dy * t;
    }
  }
  dx = p.x - x;
  dy = p.y - y;
  return dx * dx + dy * dy;
}
function simplifyRadialDist(points, sqTolerance) {
  let prevPoint = points[0];
  const newPoints = [prevPoint];
  let point;
  for (let i = 1, len = points.length; i < len; i++) {
    point = points[i];
    if (getSqDist(point, prevPoint) > sqTolerance) {
      newPoints.push(point);
      prevPoint = point;
    }
  }
  if (prevPoint !== point && point)
    newPoints.push(point);
  return newPoints;
}
function simplifyDPStep(points, first, last, sqTolerance, simplified) {
  let maxSqDist = sqTolerance;
  let index = 0;
  for (let i = first + 1; i < last; i++) {
    const sqDist = getSqSegDist(points[i], points[first], points[last]);
    if (sqDist > maxSqDist) {
      index = i;
      maxSqDist = sqDist;
    }
  }
  if (maxSqDist > sqTolerance) {
    if (index - first > 1)
      simplifyDPStep(points, first, index, sqTolerance, simplified);
    simplified.push(points[index]);
    if (last - index > 1)
      simplifyDPStep(points, index, last, sqTolerance, simplified);
  }
}
function simplifyDouglasPeucker(points, sqTolerance) {
  const last = points.length - 1;
  const simplified = [points[0]];
  simplifyDPStep(points, 0, last, sqTolerance, simplified);
  simplified.push(points[last]);
  return simplified;
}
function simplify(points, tolerance, highestQuality = false) {
  if (points.length <= 2)
    return points;
  const sqTolerance = tolerance !== void 0 ? tolerance * tolerance : 1;
  points = highestQuality ? points : simplifyRadialDist(points, sqTolerance);
  points = simplifyDouglasPeucker(points, sqTolerance);
  return points;
}

// src/models/draw.ts
var DrawModel = class extends BaseModel {
  constructor() {
    super(...arguments);
    this.points = [];
    this.count = 0;
  }
  onStart(point) {
    this.el = this.createElement("path", { fill: "transparent" });
    this.points = [point];
    if (this.brush.arrowEnd) {
      this.arrowId = guid();
      const head = createArrowHead(this.arrowId, this.brush.color);
      this.el.appendChild(head);
    }
    return this.el;
  }
  onMove(point) {
    if (!this.el)
      this.onStart(point);
    if (this.points[this.points.length - 1] !== point) {
      this.points.push(point);
      this.count += 1;
    }
    if (this.count > 5) {
      this.points = simplify(this.points, 1, true);
      this.count = 0;
    }
    this.attr("d", toSvgData(this.points));
    return true;
  }
  onEnd() {
    const path = this.el;
    this.el = null;
    if (!path)
      return false;
    path.setAttribute("d", toSvgData(simplify(this.points, 1, true)));
    if (!path.getTotalLength())
      return false;
    return true;
  }
};
function line(a, b) {
  const lengthX = b.x - a.x;
  const lengthY = b.y - a.y;
  return {
    length: Math.sqrt(lengthX ** 2 + lengthY ** 2),
    angle: Math.atan2(lengthY, lengthX)
  };
}
function controlPoint(current, previous, next, reverse) {
  const p = previous || current;
  const n = next || current;
  const smoothing = 0.2;
  const o = line(p, n);
  const angle = o.angle + (reverse ? Math.PI : 0);
  const length = o.length * smoothing;
  const x = current.x + Math.cos(angle) * length;
  const y = current.y + Math.sin(angle) * length;
  return { x, y };
}
function bezierCommand(point, i, points) {
  const cps = controlPoint(points[i - 1], points[i - 2], point);
  const cpe = controlPoint(point, points[i - 1], points[i + 1], true);
  return `C ${cps.x.toFixed(D)},${cps.y.toFixed(D)} ${cpe.x.toFixed(D)},${cpe.y.toFixed(D)} ${point.x.toFixed(D)},${point.y.toFixed(D)}`;
}
function toSvgData(points) {
  return points.reduce(
    (acc, point, i, a) => i === 0 ? `M ${point.x.toFixed(D)},${point.y.toFixed(D)}` : `${acc} ${bezierCommand(point, i, a)}`,
    ""
  );
}

// src/models/eraser.ts
var EraserModel = class extends BaseModel {
  constructor() {
    super(...arguments);
    this.pathSubFactor = 20;
    this.pathFragments = [];
  }
  onSelected(el) {
    const calculatePathFragments = (children, element) => {
      if (children && children.length) {
        for (let i = 0; i < children.length; i++) {
          const ele = children[i];
          if (ele.getTotalLength) {
            const pathLength = ele.getTotalLength();
            for (let j = 0; j < this.pathSubFactor; j++) {
              const pos1 = ele.getPointAtLength(pathLength * j / this.pathSubFactor);
              const pos2 = ele.getPointAtLength(pathLength * (j + 1) / this.pathSubFactor);
              this.pathFragments.push({
                x1: pos1.x,
                x2: pos2.x,
                y1: pos1.y,
                y2: pos2.y,
                segment: j,
                element: element || ele
              });
            }
          } else {
            if (ele.children)
              calculatePathFragments(ele.children, ele);
          }
        }
      }
    };
    if (el)
      calculatePathFragments(el.children);
  }
  onUnselected() {
    this.pathFragments = [];
  }
  onStart(point) {
    this.svgPointPrevious = this.svgElement.createSVGPoint();
    this.svgPointPrevious.x = point.x;
    this.svgPointPrevious.y = point.y;
    return void 0;
  }
  onMove(point) {
    this.svgPointCurrent = this.svgElement.createSVGPoint();
    this.svgPointCurrent.x = point.x;
    this.svgPointCurrent.y = point.y;
    const erased = this.checkAndEraseElement();
    this.svgPointPrevious = this.svgPointCurrent;
    return erased;
  }
  onEnd() {
    this.svgPointPrevious = void 0;
    this.svgPointCurrent = void 0;
    return true;
  }
  checkAndEraseElement() {
    const erased = [];
    if (this.pathFragments.length) {
      for (let i = 0; i < this.pathFragments.length; i++) {
        const segment = this.pathFragments[i];
        const line2 = {
          x1: this.svgPointPrevious.x,
          x2: this.svgPointCurrent.x,
          y1: this.svgPointPrevious.y,
          y2: this.svgPointCurrent.y
        };
        if (this.lineLineIntersect(segment, line2)) {
          segment.element.remove();
          erased.push(i);
        }
      }
    }
    if (erased.length)
      this.pathFragments = this.pathFragments.filter((v, i) => !erased.includes(i));
    return erased.length > 0;
  }
  lineLineIntersect(line1, line2) {
    const x1 = line1.x1;
    const x2 = line1.x2;
    const x3 = line2.x1;
    const x4 = line2.x2;
    const y1 = line1.y1;
    const y2 = line1.y2;
    const y3 = line2.y1;
    const y4 = line2.y2;
    const pt_denom = (x1 - x2) * (y3 - y4) - (y1 - y2) * (x3 - x4);
    const pt_x_num = (x1 * y2 - y1 * x2) * (x3 - x4) - (x1 - x2) * (x3 * y4 - y3 * x4);
    const pt_y_num = (x1 * y2 - y1 * x2) * (y3 - y4) - (y1 - y2) * (x3 * y4 - y3 * x4);
    const btwn = (a, b1, b2) => {
      if (a >= b1 && a <= b2)
        return true;
      return a >= b2 && a <= b1;
    };
    if (pt_denom === 0) {
      return false;
    } else {
      const pt = {
        x: pt_x_num / pt_denom,
        y: pt_y_num / pt_denom
      };
      return btwn(pt.x, x1, x2) && btwn(pt.y, y1, y2) && btwn(pt.x, x3, x4) && btwn(pt.y, y3, y4);
    }
  }
};

// src/models/index.ts
function createModels(drauu) {
  return {
    draw: new DrawModel(drauu),
    stylus: new StylusModel(drauu),
    line: new LineModel(drauu),
    rectangle: new RectModel(drauu),
    ellipse: new EllipseModel(drauu),
    eraseLine: new EraserModel(drauu)
  };
}

// src/drauu.ts
var Drauu = class {
  constructor(options = {}) {
    this.options = options;
    this.el = null;
    this.svgPoint = null;
    this.eventEl = null;
    this.shiftPressed = false;
    this.altPressed = false;
    this.drawing = false;
    this._emitter = createNanoEvents();
    this._models = createModels(this);
    this._undoStack = [];
    this._disposables = [];
    if (!this.options.brush)
      this.options.brush = { color: "black", size: 3, mode: "stylus" };
    if (options.el)
      this.mount(options.el, options.eventTarget);
  }
  get model() {
    return this._models[this.mode];
  }
  get mounted() {
    return !!this.el;
  }
  get mode() {
    return this.options.brush.mode || "stylus";
  }
  set mode(v) {
    const unselected = this._models[this.mode];
    unselected.onUnselected();
    this.options.brush.mode = v;
    this.model.onSelected(this.el);
  }
  get brush() {
    return this.options.brush;
  }
  set brush(v) {
    this.options.brush = v;
  }
  resolveSelector(selector) {
    if (typeof selector === "string")
      return document.querySelector(selector);
    else
      return selector || null;
  }
  mount(el, eventEl) {
    if (this.el)
      throw new Error("[drauu] already mounted, unmount previous target first");
    this.el = this.resolveSelector(el);
    if (!this.el)
      throw new Error("[drauu] target element not found");
    if (this.el.tagName.toLocaleLowerCase() !== "svg")
      throw new Error("[drauu] can only mount to a SVG element");
    if (!this.el.createSVGPoint)
      throw new Error("[drauu] SVG element must be create by document.createElementNS('http://www.w3.org/2000/svg', 'svg')");
    this.svgPoint = this.el.createSVGPoint();
    const target = this.resolveSelector(eventEl) || this.el;
    const start = this.eventStart.bind(this);
    const move = this.eventMove.bind(this);
    const end = this.eventEnd.bind(this);
    const keyboard = this.eventKeyboard.bind(this);
    target.addEventListener("pointerdown", start, { passive: false });
    window.addEventListener("pointermove", move, { passive: false });
    window.addEventListener("pointerup", end, { passive: false });
    window.addEventListener("pointercancel", end, { passive: false });
    window.addEventListener("keydown", keyboard, false);
    window.addEventListener("keyup", keyboard, false);
    this._disposables.push(() => {
      target.removeEventListener("pointerdown", start);
      window.removeEventListener("pointermove", move);
      window.removeEventListener("pointerup", end);
      window.removeEventListener("pointercancel", end);
      window.removeEventListener("keydown", keyboard, false);
      window.removeEventListener("keyup", keyboard, false);
    });
    this._emitter.emit("mounted");
  }
  unmount() {
    this._disposables.forEach((fn) => fn());
    this._disposables.length = 0;
    this.el = null;
    this._emitter.emit("unmounted");
  }
  on(type, fn) {
    return this._emitter.on(type, fn);
  }
  undo() {
    const el = this.el;
    if (!el.lastElementChild)
      return false;
    this._undoStack.push(el.lastElementChild.cloneNode(true));
    el.lastElementChild.remove();
    this._emitter.emit("changed");
    return true;
  }
  redo() {
    if (!this._undoStack.length)
      return false;
    this.el.appendChild(this._undoStack.pop());
    this._emitter.emit("changed");
    return true;
  }
  canRedo() {
    return !!this._undoStack.length;
  }
  canUndo() {
    var _a;
    return !!((_a = this.el) == null ? void 0 : _a.lastElementChild);
  }
  eventMove(event) {
    if (!this.acceptsInput(event) || !this.drawing)
      return;
    if (this.model._eventMove(event)) {
      event.stopPropagation();
      event.preventDefault();
      this._emitter.emit("changed");
    }
  }
  eventStart(event) {
    if (!this.acceptsInput(event))
      return;
    event.stopPropagation();
    event.preventDefault();
    if (this._currentNode)
      this.cancel();
    this.drawing = true;
    this._emitter.emit("start");
    this._currentNode = this.model._eventDown(event);
    if (this._currentNode && this.mode !== "eraseLine")
      this.el.appendChild(this._currentNode);
    this._emitter.emit("changed");
  }
  eventEnd(event) {
    if (!this.acceptsInput(event) || !this.drawing)
      return;
    const result = this.model._eventUp(event);
    if (!result) {
      this.cancel();
    } else {
      if (result instanceof Element && result !== this._currentNode)
        this._currentNode = result;
      this.commit();
    }
    this.drawing = false;
    this._emitter.emit("end");
    this._emitter.emit("changed");
  }
  acceptsInput(event) {
    return !this.options.acceptsInputTypes || this.options.acceptsInputTypes.includes(event.pointerType);
  }
  eventKeyboard(event) {
    if (this.shiftPressed === event.shiftKey && this.altPressed === event.altKey)
      return;
    this.shiftPressed = event.shiftKey;
    this.altPressed = event.altKey;
    if (this.model.point) {
      if (this.model.onMove(this.model.point))
        this._emitter.emit("changed");
    }
  }
  commit() {
    this._undoStack.length = 0;
    const node = this._currentNode;
    this._currentNode = void 0;
    this._emitter.emit("committed", node);
  }
  clear() {
    this._undoStack.length = 0;
    this.cancel();
    this.el.innerHTML = "";
    this._emitter.emit("changed");
  }
  cancel() {
    if (this._currentNode) {
      this.el.removeChild(this._currentNode);
      this._currentNode = void 0;
      this._emitter.emit("canceled");
    }
  }
  dump() {
    return this.el.innerHTML;
  }
  load(svg) {
    this.clear();
    this.el.innerHTML = svg;
  }
};
function createDrauu(options) {
  return new Drauu(options);
}

var __defProp = Object.defineProperty;
var __getOwnPropSymbols = Object.getOwnPropertySymbols;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __propIsEnum = Object.prototype.propertyIsEnumerable;
var __defNormalProp = (obj, key, value) => key in obj ? __defProp(obj, key, { enumerable: true, configurable: true, writable: true, value }) : obj[key] = value;
var __spreadValues = (a, b) => {
  for (var prop in b || (b = {}))
    if (__hasOwnProp.call(b, prop))
      __defNormalProp(a, prop, b[prop]);
  if (__getOwnPropSymbols)
    for (var prop of __getOwnPropSymbols(b)) {
      if (__propIsEnum.call(b, prop))
        __defNormalProp(a, prop, b[prop]);
    }
  return a;
};
function useDrauu(target, options) {
  const drauuInstance = ref();
  let disposables = [];
  const onChangedHook = createEventHook();
  const onCanceledHook = createEventHook();
  const onCommittedHook = createEventHook();
  const onStartHook = createEventHook();
  const onEndHook = createEventHook();
  const canUndo = ref(false);
  const canRedo = ref(false);
  const altPressed = ref(false);
  const shiftPressed = ref(false);
  const brush = ref({
    color: "black",
    size: 3,
    arrowEnd: false,
    cornerRadius: 0,
    dasharray: void 0,
    fill: "transparent",
    mode: "draw"
  });
  watch(brush, () => {
    const instance = drauuInstance.value;
    if (instance) {
      instance.brush = brush.value;
      instance.mode = brush.value.mode;
    }
  }, { deep: true });
  const undo = () => {
    var _a;
    return (_a = drauuInstance.value) == null ? void 0 : _a.undo();
  };
  const redo = () => {
    var _a;
    return (_a = drauuInstance.value) == null ? void 0 : _a.redo();
  };
  const clear = () => {
    var _a;
    return (_a = drauuInstance.value) == null ? void 0 : _a.clear();
  };
  const cancel = () => {
    var _a;
    return (_a = drauuInstance.value) == null ? void 0 : _a.cancel();
  };
  const load = (svg) => {
    var _a;
    return (_a = drauuInstance.value) == null ? void 0 : _a.load(svg);
  };
  const dump = () => {
    var _a;
    return (_a = drauuInstance.value) == null ? void 0 : _a.dump();
  };
  const cleanup = () => {
    var _a;
    disposables.forEach((dispose) => dispose());
    (_a = drauuInstance.value) == null ? void 0 : _a.unmount();
  };
  const syncStatus = () => {
    if (drauuInstance.value) {
      canUndo.value = drauuInstance.value.canUndo();
      canRedo.value = drauuInstance.value.canRedo();
      altPressed.value = drauuInstance.value.altPressed;
      shiftPressed.value = drauuInstance.value.shiftPressed;
    }
  };
  watch(
    () => unrefElement(target),
    (el) => {
      if (!el || typeof SVGSVGElement === "undefined" || !(el instanceof SVGSVGElement))
        return;
      if (drauuInstance.value)
        cleanup();
      drauuInstance.value = createDrauu(__spreadValues({ el }, options));
      syncStatus();
      disposables = [
        drauuInstance.value.on("canceled", () => onCanceledHook.trigger()),
        drauuInstance.value.on("committed", () => onCommittedHook.trigger()),
        drauuInstance.value.on("start", () => onStartHook.trigger()),
        drauuInstance.value.on("end", () => onEndHook.trigger()),
        drauuInstance.value.on("changed", () => {
          syncStatus();
          onChangedHook.trigger();
        })
      ];
    },
    { flush: "post" }
  );
  tryOnScopeDispose(() => cleanup());
  return {
    drauuInstance,
    load,
    dump,
    clear,
    cancel,
    undo,
    redo,
    canUndo,
    canRedo,
    brush,
    onChanged: onChangedHook.on,
    onCommitted: onCommittedHook.on,
    onStart: onStartHook.on,
    onEnd: onEndHook.on,
    onCanceled: onCanceledHook.on
  };
}

const XpDraw_vue_vue_type_style_index_0_scoped_a15caa2a_lang = '';

const _hoisted_1 = { class: "toolbar" };
const _hoisted_2 = ["onClick"];
const _hoisted_3 = ["onClick"];


const _sfc_main = {
  __name: 'XpDraw',
  props: {
    name: {
        type: String,
        default: 'contact'
    }
},
  setup(__props) {



const colors = ref(['black', '#ef4444', '#22c55e', '#3b82f6']);

const modes = ref(['draw', 'line', 'rectangle', 'ellipse']);

const target = ref();
const { undo, redo, canUndo, canRedo, brush, clear, dump, load } 
= useDrauu(target, {
});

const { mode, color, size } = toRefs(brush);


return (_ctx, _cache) => {
  return (openBlock(), createElementBlock(Fragment, null, [
    createBaseVNode("div", _hoisted_1, [
      (openBlock(true), createElementBlock(Fragment, null, renderList(modes.value, (_mode) => {
        return (openBlock(), createElementBlock("div", {
          key: _mode,
          class: normalizeClass([{ active: _mode === unref(mode) }, "color-button"]),
          onClick: withModifiers(() => mode.value = _mode, ["prevent"])
        }, toDisplayString(_mode[0]), 11, _hoisted_2))
      }), 128)),
      createBaseVNode("span", null, toDisplayString(unref(mode)), 1),
      withDirectives(createBaseVNode("input", {
        type: "range",
        min: "1",
        max: "20",
        "onUpdate:modelValue": _cache[0] || (_cache[0] = $event => (isRef(size) ? (size).value = $event : null))
      }, null, 512), [
        [vModelText, unref(size)]
      ]),
      createBaseVNode("div", {
        class: "color-button",
        style: normalizeStyle({ background: unref(color) })
      }, toDisplayString(unref(size)), 5),
      (openBlock(true), createElementBlock(Fragment, null, renderList(colors.value, (_color) => {
        return (openBlock(), createElementBlock("div", {
          key: _color,
          class: normalizeClass([{ active: _color === unref(color) }, "color-button"]),
          style: normalizeStyle({ background: _color }),
          onClick: withModifiers(() => color.value = _color, ["prevent"])
        }, "v", 14, _hoisted_3))
      }), 128)),
      createBaseVNode("div", {
        class: "color-button",
        style: normalizeStyle({ background: unref(color) }),
        onClick: _cache[1] || (_cache[1] = withModifiers((...args) => (unref(undo) && unref(undo)(...args)), ["prevent"]))
      }, "😅", 4),
      createBaseVNode("div", {
        class: "color-button",
        style: normalizeStyle({ background: unref(color) }),
        onClick: _cache[2] || (_cache[2] = withModifiers((...args) => (unref(clear) && unref(clear)(...args)), ["prevent"]))
      }, "🔥", 4)
    ]),
    (openBlock(), createElementBlock("svg", {
      ref_key: "target",
      ref: target
    }, null, 512))
  ], 64))
}
}

};
const XpDraw = /*#__PURE__*/_export_sfc(_sfc_main, [['__scopeId',"data-v-a15caa2a"]]);

export { XpDraw as default };