var commonjsGlobal = typeof globalThis !== "undefined" ? globalThis : typeof window !== "undefined" ? window : typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : {};
function getDefaultExportFromCjs(x) {
  return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, "default") ? x["default"] : x;
}
var kjua_min = { exports: {} };
/*! kjua v0.10.0 - undefined */
(function(module, exports) {
  ((t, r) => {
    module.exports = r();
  })("undefined" != typeof self ? self : commonjsGlobal, () => {
    return n = [(t, r, e) => {
      function n2(t2) {
        var t2 = Object.assign({}, o2, t2), r2 = i(t2.text, t2.ecLevel, t2.minVersion, t2.quiet);
        return "svg" === t2.render ? u(r2, t2) : a(r2, t2, "image" === t2.render);
      }
      var o2 = e(1), i = e(2), a = e(4), u = e(8);
      t.exports = n2;
      try {
        jQuery.fn.kjua = function(e2) {
          return this.each(function(t2, r2) {
            return r2.appendChild(n2(e2));
          });
        };
      } catch (t2) {
      }
    }, (t) => {
      t.exports = { render: "image", crisp: true, minVersion: 1, ecLevel: "L", size: 200, ratio: null, fill: "#333", back: "#fff", text: "no text", rounded: 0, quiet: 0, mode: "plain", mSize: 30, mPosX: 50, mPosY: 50, label: "no label", fontname: "sans", fontcolor: "#333", image: null };
    }, (t, r, e) => {
      function i(t2, r2) {
        for (var e2, n2 = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : 1, o2 = Math.max(1, n2); o2 <= 40; o2 += 1) if (e2 = (() => {
          try {
            var e3 = u(o2, r2), n3 = (e3.addData(t2), e3.make(), e3.getModuleCount());
            return { v: { text: t2, level: r2, version: o2, module_count: n3, is_dark: function(t3, r3) {
              return 0 <= t3 && t3 < n3 && 0 <= r3 && r3 < n3 && e3.isDark(t3, r3);
            } } };
          } catch (t3) {
            if (!(o2 < 40 && a.test(t3))) throw new Error(t3);
          }
        })()) return e2.v;
        return null;
      }
      var a = /code length overflow/i, u = e(3);
      u.stringToBytes = u.stringToBytesFuncs["UTF-8"];
      t.exports = function() {
        var e2, t2 = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : "", r2 = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : "L", n2 = 2 < arguments.length && void 0 !== arguments[2] ? arguments[2] : 1, o2 = 3 < arguments.length && void 0 !== arguments[3] ? arguments[3] : 0, t2 = i(t2, r2, n2);
        return t2 && (e2 = t2.is_dark, t2.module_count += 2 * o2, t2.is_dark = function(t3, r3) {
          return e2(t3 - o2, r3 - o2);
        }), t2;
      };
    }, (t, r) => {
      z.stringToBytes = (z.stringToBytesFuncs = { default: function(t2) {
        for (var r2 = [], e2 = 0; e2 < t2.length; e2 += 1) {
          var n3 = t2.charCodeAt(e2);
          r2.push(255 & n3);
        }
        return r2;
      } }).default, z.createStringToBytes = function(f2, l2) {
        var o3 = (() => {
          for (var r2 = y(f2), t2 = function() {
            var t3 = r2.read();
            if (-1 == t3) throw "eof";
            return t3;
          }, e2 = 0, n3 = {}; ; ) {
            var o4 = r2.read();
            if (-1 == o4) break;
            var i3 = t2(), a2 = t2(), u2 = t2();
            n3[String.fromCharCode(o4 << 8 | i3)] = a2 << 8 | u2, e2 += 1;
          }
          if (e2 != l2) throw e2 + " != " + l2;
          return n3;
        })(), i2 = "?".charCodeAt(0);
        return function(t2) {
          for (var r2 = [], e2 = 0; e2 < t2.length; e2 += 1) {
            var n3 = t2.charCodeAt(e2);
            n3 < 128 ? r2.push(n3) : "number" == typeof (n3 = o3[t2.charAt(e2)]) ? (255 & n3) == n3 ? r2.push(n3) : (r2.push(n3 >>> 8), r2.push(255 & n3)) : r2.push(i2);
          }
          return r2;
        };
      }, u = 8, k = { L: a = 1, M: 0, Q: 3, H: i = 2 }, o2 = 0, f = 1, l = 2, c = 3, s = n2 = 4, g = 5, d = 7, e = [[], [h = 6, 18], [6, 22], [6, 26], [6, 30], [6, 34], [6, 22, 38], [6, 24, 42], [6, 26, 46], [6, 28, 50], [6, 30, 54], [6, 32, 58], [6, 34, 62], [6, 26, 46, 66], [6, 26, 48, 70], [6, 26, 50, 74], [6, 30, 54, 78], [6, 30, 56, 82], [6, 30, 58, 86], [6, 34, 62, 90], [6, 28, 50, 72, 94], [6, 26, 50, 74, 98], [6, 30, 54, 78, 102], [6, 28, 54, 80, 106], [6, 32, 58, 84, 110], [6, 30, 58, 86, 114], [6, 34, 62, 90, 118], [6, 26, 50, 74, 98, 122], [6, 30, 54, 78, 102, 126], [6, 26, 52, 78, 104, 130], [6, 30, 56, 82, 108, 134], [6, 34, 60, 86, 112, 138], [6, 30, 58, 86, 114, 142], [6, 34, 62, 90, 118, 146], [6, 30, 54, 78, 102, 126, 150], [6, 24, 50, 76, 102, 128, 154], [6, 28, 54, 80, 106, 132, 158], [6, 32, 58, 84, 110, 136, 162], [6, 26, 54, 82, 110, 138, 166], [6, 30, 58, 86, 114, 142, 170]], (w = {}).getBCHTypeInfo = function(t2) {
        for (var r2 = t2 << 10; 0 <= T(r2) - T(1335); ) r2 ^= 1335 << T(r2) - T(1335);
        return 21522 ^ (t2 << 10 | r2);
      }, w.getBCHTypeNumber = function(t2) {
        for (var r2 = t2 << 12; 0 <= T(r2) - T(7973); ) r2 ^= 7973 << T(r2) - T(7973);
        return t2 << 12 | r2;
      }, w.getPatternPosition = function(t2) {
        return e[t2 - 1];
      }, w.getMaskFunction = function(t2) {
        switch (t2) {
          case o2:
            return function(t3, r2) {
              return (t3 + r2) % 2 == 0;
            };
          case f:
            return function(t3, r2) {
              return t3 % 2 == 0;
            };
          case l:
            return function(t3, r2) {
              return r2 % 3 == 0;
            };
          case c:
            return function(t3, r2) {
              return (t3 + r2) % 3 == 0;
            };
          case s:
            return function(t3, r2) {
              return (Math.floor(t3 / 2) + Math.floor(r2 / 3)) % 2 == 0;
            };
          case g:
            return function(t3, r2) {
              return t3 * r2 % 2 + t3 * r2 % 3 == 0;
            };
          case h:
            return function(t3, r2) {
              return (t3 * r2 % 2 + t3 * r2 % 3) % 2 == 0;
            };
          case d:
            return function(t3, r2) {
              return (t3 * r2 % 3 + (t3 + r2) % 2) % 2 == 0;
            };
          default:
            throw "bad maskPattern:" + t2;
        }
      }, w.getErrorCorrectPolynomial = function(t2) {
        for (var r2 = _([1], 0), e2 = 0; e2 < t2; e2 += 1) r2 = r2.multiply(_([1, v.gexp(e2)], 0));
        return r2;
      }, w.getLengthInBits = function(t2, r2) {
        if (1 <= r2 && r2 < 10) switch (t2) {
          case a:
            return 10;
          case i:
            return 9;
          case n2:
          case u:
            return 8;
          default:
            throw "mode:" + t2;
        }
        else if (r2 < 27) switch (t2) {
          case a:
            return 12;
          case i:
            return 11;
          case n2:
            return 16;
          case u:
            return 10;
          default:
            throw "mode:" + t2;
        }
        else {
          if (!(r2 < 41)) throw "type:" + r2;
          switch (t2) {
            case a:
              return 14;
            case i:
              return 13;
            case n2:
              return 16;
            case u:
              return 12;
            default:
              throw "mode:" + t2;
          }
        }
      }, w.getLostPoint = function(t2) {
        for (var r2 = t2.getModuleCount(), e2 = 0, n3 = 0; n3 < r2; n3 += 1) for (var o3 = 0; o3 < r2; o3 += 1) {
          for (var i2 = 0, a2 = t2.isDark(n3, o3), u2 = -1; u2 <= 1; u2 += 1) if (!(n3 + u2 < 0 || r2 <= n3 + u2)) for (var f2 = -1; f2 <= 1; f2 += 1) o3 + f2 < 0 || r2 <= o3 + f2 || 0 == u2 && 0 == f2 || a2 == t2.isDark(n3 + u2, o3 + f2) && (i2 += 1);
          5 < i2 && (e2 += 3 + i2 - 5);
        }
        for (n3 = 0; n3 < r2 - 1; n3 += 1) for (o3 = 0; o3 < r2 - 1; o3 += 1) {
          var l2 = 0;
          t2.isDark(n3, o3) && (l2 += 1), t2.isDark(n3 + 1, o3) && (l2 += 1), t2.isDark(n3, o3 + 1) && (l2 += 1), t2.isDark(n3 + 1, o3 + 1) && (l2 += 1), 0 != l2 && 4 != l2 || (e2 += 3);
        }
        for (n3 = 0; n3 < r2; n3 += 1) for (o3 = 0; o3 < r2 - 6; o3 += 1) t2.isDark(n3, o3) && !t2.isDark(n3, o3 + 1) && t2.isDark(n3, o3 + 2) && t2.isDark(n3, o3 + 3) && t2.isDark(n3, o3 + 4) && !t2.isDark(n3, o3 + 5) && t2.isDark(n3, o3 + 6) && (e2 += 40);
        for (o3 = 0; o3 < r2; o3 += 1) for (n3 = 0; n3 < r2 - 6; n3 += 1) t2.isDark(n3, o3) && !t2.isDark(n3 + 1, o3) && t2.isDark(n3 + 2, o3) && t2.isDark(n3 + 3, o3) && t2.isDark(n3 + 4, o3) && !t2.isDark(n3 + 5, o3) && t2.isDark(n3 + 6, o3) && (e2 += 40);
        for (var c2 = 0, o3 = 0; o3 < r2; o3 += 1) for (n3 = 0; n3 < r2; n3 += 1) t2.isDark(n3, o3) && (c2 += 1);
        return e2 += 10 * (Math.abs(100 * c2 / r2 / r2 - 50) / 5);
      }, x = w, v = (() => {
        for (var r2 = new Array(256), e2 = new Array(256), t2 = 0; t2 < 8; t2 += 1) r2[t2] = 1 << t2;
        for (t2 = 8; t2 < 256; t2 += 1) r2[t2] = r2[t2 - 4] ^ r2[t2 - 5] ^ r2[t2 - 6] ^ r2[t2 - 8];
        for (t2 = 0; t2 < 255; t2 += 1) e2[r2[t2]] = t2;
        var n3 = { glog: function(t3) {
          if (t3 < 1) throw "glog(" + t3 + ")";
          return e2[t3];
        }, gexp: function(t3) {
          for (; t3 < 0; ) t3 += 255;
          for (; 256 <= t3; ) t3 -= 255;
          return r2[t3];
        } };
        return n3;
      })(), p = [[1, 26, 19], [1, 26, 16], [1, 26, 13], [1, 26, 9], [1, 44, 34], [1, 44, 28], [1, 44, 22], [1, 44, 16], [1, 70, 55], [1, 70, 44], [2, 35, 17], [2, 35, 13], [1, 100, 80], [2, 50, 32], [2, 50, 24], [4, 25, 9], [1, 134, 108], [2, 67, 43], [2, 33, 15, 2, 34, 16], [2, 33, 11, 2, 34, 12], [2, 86, 68], [4, 43, 27], [4, 43, 19], [4, 43, 15], [2, 98, 78], [4, 49, 31], [2, 32, 14, 4, 33, 15], [4, 39, 13, 1, 40, 14], [2, 121, 97], [2, 60, 38, 2, 61, 39], [4, 40, 18, 2, 41, 19], [4, 40, 14, 2, 41, 15], [2, 146, 116], [3, 58, 36, 2, 59, 37], [4, 36, 16, 4, 37, 17], [4, 36, 12, 4, 37, 13], [2, 86, 68, 2, 87, 69], [4, 69, 43, 1, 70, 44], [6, 43, 19, 2, 44, 20], [6, 43, 15, 2, 44, 16], [4, 101, 81], [1, 80, 50, 4, 81, 51], [4, 50, 22, 4, 51, 23], [3, 36, 12, 8, 37, 13], [2, 116, 92, 2, 117, 93], [6, 58, 36, 2, 59, 37], [4, 46, 20, 6, 47, 21], [7, 42, 14, 4, 43, 15], [4, 133, 107], [8, 59, 37, 1, 60, 38], [8, 44, 20, 4, 45, 21], [12, 33, 11, 4, 34, 12], [3, 145, 115, 1, 146, 116], [4, 64, 40, 5, 65, 41], [11, 36, 16, 5, 37, 17], [11, 36, 12, 5, 37, 13], [5, 109, 87, 1, 110, 88], [5, 65, 41, 5, 66, 42], [5, 54, 24, 7, 55, 25], [11, 36, 12, 7, 37, 13], [5, 122, 98, 1, 123, 99], [7, 73, 45, 3, 74, 46], [15, 43, 19, 2, 44, 20], [3, 45, 15, 13, 46, 16], [1, 135, 107, 5, 136, 108], [10, 74, 46, 1, 75, 47], [1, 50, 22, 15, 51, 23], [2, 42, 14, 17, 43, 15], [5, 150, 120, 1, 151, 121], [9, 69, 43, 4, 70, 44], [17, 50, 22, 1, 51, 23], [2, 42, 14, 19, 43, 15], [3, 141, 113, 4, 142, 114], [3, 70, 44, 11, 71, 45], [17, 47, 21, 4, 48, 22], [9, 39, 13, 16, 40, 14], [3, 135, 107, 5, 136, 108], [3, 67, 41, 13, 68, 42], [15, 54, 24, 5, 55, 25], [15, 43, 15, 10, 44, 16], [4, 144, 116, 4, 145, 117], [17, 68, 42], [17, 50, 22, 6, 51, 23], [19, 46, 16, 6, 47, 17], [2, 139, 111, 7, 140, 112], [17, 74, 46], [7, 54, 24, 16, 55, 25], [34, 37, 13], [4, 151, 121, 5, 152, 122], [4, 75, 47, 14, 76, 48], [11, 54, 24, 14, 55, 25], [16, 45, 15, 14, 46, 16], [6, 147, 117, 4, 148, 118], [6, 73, 45, 14, 74, 46], [11, 54, 24, 16, 55, 25], [30, 46, 16, 2, 47, 17], [8, 132, 106, 4, 133, 107], [8, 75, 47, 13, 76, 48], [7, 54, 24, 22, 55, 25], [22, 45, 15, 13, 46, 16], [10, 142, 114, 2, 143, 115], [19, 74, 46, 4, 75, 47], [28, 50, 22, 6, 51, 23], [33, 46, 16, 4, 47, 17], [8, 152, 122, 4, 153, 123], [22, 73, 45, 3, 74, 46], [8, 53, 23, 26, 54, 24], [12, 45, 15, 28, 46, 16], [3, 147, 117, 10, 148, 118], [3, 73, 45, 23, 74, 46], [4, 54, 24, 31, 55, 25], [11, 45, 15, 31, 46, 16], [7, 146, 116, 7, 147, 117], [21, 73, 45, 7, 74, 46], [1, 53, 23, 37, 54, 24], [19, 45, 15, 26, 46, 16], [5, 145, 115, 10, 146, 116], [19, 75, 47, 10, 76, 48], [15, 54, 24, 25, 55, 25], [23, 45, 15, 25, 46, 16], [13, 145, 115, 3, 146, 116], [2, 74, 46, 29, 75, 47], [42, 54, 24, 1, 55, 25], [23, 45, 15, 28, 46, 16], [17, 145, 115], [10, 74, 46, 23, 75, 47], [10, 54, 24, 35, 55, 25], [19, 45, 15, 35, 46, 16], [17, 145, 115, 1, 146, 116], [14, 74, 46, 21, 75, 47], [29, 54, 24, 19, 55, 25], [11, 45, 15, 46, 46, 16], [13, 145, 115, 6, 146, 116], [14, 74, 46, 23, 75, 47], [44, 54, 24, 7, 55, 25], [59, 46, 16, 1, 47, 17], [12, 151, 121, 7, 152, 122], [12, 75, 47, 26, 76, 48], [39, 54, 24, 14, 55, 25], [22, 45, 15, 41, 46, 16], [6, 151, 121, 14, 152, 122], [6, 75, 47, 34, 76, 48], [46, 54, 24, 10, 55, 25], [2, 45, 15, 64, 46, 16], [17, 152, 122, 4, 153, 123], [29, 74, 46, 14, 75, 47], [49, 54, 24, 10, 55, 25], [24, 45, 15, 46, 46, 16], [4, 152, 122, 18, 153, 123], [13, 74, 46, 32, 75, 47], [48, 54, 24, 14, 55, 25], [42, 45, 15, 32, 46, 16], [20, 147, 117, 4, 148, 118], [40, 75, 47, 7, 76, 48], [43, 54, 24, 22, 55, 25], [10, 45, 15, 67, 46, 16], [19, 148, 118, 6, 149, 119], [18, 75, 47, 31, 76, 48], [34, 54, 24, 34, 55, 25], [20, 45, 15, 61, 46, 16]], (w = {}).getRSBlocks = function(t2, r2) {
        var e2 = ((t3, r3) => {
          switch (r3) {
            case k.L:
              return p[4 * (t3 - 1) + 0];
            case k.M:
              return p[4 * (t3 - 1) + 1];
            case k.Q:
              return p[4 * (t3 - 1) + 2];
            case k.H:
              return p[4 * (t3 - 1) + 3];
            default:
              return;
          }
        })(t2, r2);
        if (void 0 === e2) throw "bad rs block @ typeNumber:" + t2 + "/errorCorrectionLevel:" + r2;
        for (var n3, o3, i2 = e2.length / 3, a2 = [], u2 = 0; u2 < i2; u2 += 1) for (var f2 = e2[3 * u2 + 0], l2 = e2[3 * u2 + 1], c2 = e2[3 * u2 + 2], s2 = 0; s2 < f2; s2 += 1) a2.push((n3 = c2, (o3 = {}).totalCount = l2, o3.dataCount = n3, o3));
        return a2;
      }, b = w, B = function() {
        var e2 = [], n3 = 0, o3 = { getBuffer: function() {
          return e2;
        }, getAt: function(t2) {
          var r2 = Math.floor(t2 / 8);
          return 1 == (e2[r2] >>> 7 - t2 % 8 & 1);
        }, put: function(t2, r2) {
          for (var e3 = 0; e3 < r2; e3 += 1) o3.putBit(1 == (t2 >>> r2 - e3 - 1 & 1));
        }, getLengthInBits: function() {
          return n3;
        }, putBit: function(t2) {
          var r2 = Math.floor(n3 / 8);
          e2.length <= r2 && e2.push(0), t2 && (e2[r2] |= 128 >>> n3 % 8), n3 += 1;
        } };
        return o3;
      }, C = function(t2) {
        var r2 = a, n3 = t2, t2 = { getMode: function() {
          return r2;
        }, getLength: function(t3) {
          return n3.length;
        }, write: function(t3) {
          for (var r3 = n3, e2 = 0; e2 + 2 < r3.length; ) t3.put(o3(r3.substring(e2, e2 + 3)), 10), e2 += 3;
          e2 < r3.length && (r3.length - e2 == 1 ? t3.put(o3(r3.substring(e2, e2 + 1)), 4) : r3.length - e2 == 2 && t3.put(o3(r3.substring(e2, e2 + 2)), 7));
        } }, o3 = function(t3) {
          for (var r3 = 0, e2 = 0; e2 < t3.length; e2 += 1) r3 = 10 * r3 + i2(t3.charAt(e2));
          return r3;
        }, i2 = function(t3) {
          if ("0" <= t3 && t3 <= "9") return t3.charCodeAt(0) - "0".charCodeAt(0);
          throw "illegal char :" + t3;
        };
        return t2;
      }, M = function(t2) {
        var r2 = i, n3 = t2, t2 = { getMode: function() {
          return r2;
        }, getLength: function(t3) {
          return n3.length;
        }, write: function(t3) {
          for (var r3 = n3, e2 = 0; e2 + 1 < r3.length; ) t3.put(45 * o3(r3.charAt(e2)) + o3(r3.charAt(e2 + 1)), 11), e2 += 2;
          e2 < r3.length && t3.put(o3(r3.charAt(e2)), 6);
        } }, o3 = function(t3) {
          if ("0" <= t3 && t3 <= "9") return t3.charCodeAt(0) - "0".charCodeAt(0);
          if ("A" <= t3 && t3 <= "Z") return t3.charCodeAt(0) - "A".charCodeAt(0) + 10;
          switch (t3) {
            case " ":
              return 36;
            case "$":
              return 37;
            case "%":
              return 38;
            case "*":
              return 39;
            case "+":
              return 40;
            case "-":
              return 41;
            case ".":
              return 42;
            case "/":
              return 43;
            case ":":
              return 44;
            default:
              throw "illegal char :" + t3;
          }
        };
        return t2;
      }, S = function(t2) {
        var r2 = n2, e2 = z.stringToBytes(t2), t2 = { getMode: function() {
          return r2;
        }, getLength: function(t3) {
          return e2.length;
        }, write: function(t3) {
          for (var r3 = 0; r3 < e2.length; r3 += 1) t3.put(e2[r3], 8);
        } };
        return t2;
      }, L = function(t2) {
        var r2 = u, e2 = z.stringToBytesFuncs.SJIS;
        if (!e2) throw "sjis not supported.";
        var n3 = e2("友");
        if (2 != n3.length || 38726 != (n3[0] << 8 | n3[1])) throw "sjis not supported.";
        var o3 = e2(t2), n3 = { getMode: function() {
          return r2;
        }, getLength: function(t3) {
          return ~~(o3.length / 2);
        }, write: function(t3) {
          for (var r3 = o3, e3 = 0; e3 + 1 < r3.length; ) {
            var n4 = (255 & r3[e3]) << 8 | 255 & r3[e3 + 1];
            if (33088 <= n4 && n4 <= 40956) n4 -= 33088;
            else {
              if (!(57408 <= n4 && n4 <= 60351)) throw "illegal char at " + (e3 + 1) + "/" + n4;
              n4 -= 49472;
            }
            t3.put(n4 = 192 * (n4 >>> 8 & 255) + (255 & n4), 13), e3 += 2;
          }
          if (e3 < r3.length) throw "illegal char at " + (e3 + 1);
        } };
        return n3;
      }, m = function() {
        var e2 = [], o3 = { writeByte: function(t2) {
          e2.push(255 & t2);
        }, writeShort: function(t2) {
          o3.writeByte(t2), o3.writeByte(t2 >>> 8);
        }, writeBytes: function(t2, r2, e3) {
          r2 = r2 || 0, e3 = e3 || t2.length;
          for (var n3 = 0; n3 < e3; n3 += 1) o3.writeByte(t2[n3 + r2]);
        }, writeString: function(t2) {
          for (var r2 = 0; r2 < t2.length; r2 += 1) o3.writeByte(t2.charCodeAt(r2));
        }, toByteArray: function() {
          return e2;
        }, toString: function() {
          var t2 = "";
          t2 += "[";
          for (var r2 = 0; r2 < e2.length; r2 += 1) 0 < r2 && (t2 += ","), t2 += e2[r2];
          return t2 += "]";
        } };
        return o3;
      }, y = function(t2) {
        var e2 = t2, n3 = 0, o3 = 0, i2 = 0, t2 = { read: function() {
          for (; i2 < 8; ) {
            if (n3 >= e2.length) {
              if (0 == i2) return -1;
              throw "unexpected end of file./" + i2;
            }
            var t3 = e2.charAt(n3);
            if (n3 += 1, "=" == t3) return i2 = 0, -1;
            t3.match(/^\s$/) || (o3 = o3 << 6 | a2(t3.charCodeAt(0)), i2 += 6);
          }
          var r2 = o3 >>> i2 - 8 & 255;
          return i2 -= 8, r2;
        } }, a2 = function(t3) {
          if (65 <= t3 && t3 <= 90) return t3 - 65;
          if (97 <= t3 && t3 <= 122) return t3 - 97 + 26;
          if (48 <= t3 && t3 <= 57) return t3 - 48 + 52;
          if (43 == t3) return 62;
          if (47 == t3) return 63;
          throw "c:" + t3;
        };
        return t2;
      }, D = function(t2, r2, e2) {
        for (var n3 = j(t2, r2), o3 = 0; o3 < r2; o3 += 1) for (var i2 = 0; i2 < t2; i2 += 1) n3.setPixel(i2, o3, e2(i2, o3));
        for (var a2 = m(), u2 = (n3.write(a2), P()), f2 = a2.toByteArray(), l2 = 0; l2 < f2.length; l2 += 1) u2.writeByte(f2[l2]);
        return u2.flush(), "data:image/gif;base64," + u2;
      };
      var e, a, i, n2, u, k, o2, f, l, c, s, g, h, d, x, v, p, w, b, B, C, M, S, L, m, y, D, A = z;
      function z(t2, r2) {
        function a2(t3, r3) {
          s2 = ((t4) => {
            for (var r4 = new Array(t4), e3 = 0; e3 < t4; e3 += 1) {
              r4[e3] = new Array(t4);
              for (var n4 = 0; n4 < t4; n4 += 1) r4[e3][n4] = null;
            }
            return r4;
          })(g2 = 4 * u2 + 17), e2(0, 0), e2(g2 - 7, 0), e2(0, g2 - 7), i2(), o3(), v2(t3, r3), 7 <= u2 && d2(t3), null == n3 && (n3 = m2(u2, c2, h2)), p2(n3, r3);
        }
        var f2 = 236, l2 = 17, u2 = t2, c2 = k[r2], s2 = null, g2 = 0, n3 = null, h2 = [], A2 = {}, e2 = function(t3, r3) {
          for (var e3 = -1; e3 <= 7; e3 += 1) if (!(t3 + e3 <= -1 || g2 <= t3 + e3)) for (var n4 = -1; n4 <= 7; n4 += 1) r3 + n4 <= -1 || g2 <= r3 + n4 || (s2[t3 + e3][r3 + n4] = 0 <= e3 && e3 <= 6 && (0 == n4 || 6 == n4) || 0 <= n4 && n4 <= 6 && (0 == e3 || 6 == e3) || 2 <= e3 && e3 <= 4 && 2 <= n4 && n4 <= 4);
        }, o3 = function() {
          for (var t3 = 8; t3 < g2 - 8; t3 += 1) null == s2[t3][6] && (s2[t3][6] = t3 % 2 == 0);
          for (var r3 = 8; r3 < g2 - 8; r3 += 1) null == s2[6][r3] && (s2[6][r3] = r3 % 2 == 0);
        }, i2 = function() {
          for (var t3 = x.getPatternPosition(u2), r3 = 0; r3 < t3.length; r3 += 1) for (var e3 = 0; e3 < t3.length; e3 += 1) {
            var n4 = t3[r3], o4 = t3[e3];
            if (null == s2[n4][o4]) for (var i3 = -2; i3 <= 2; i3 += 1) for (var a3 = -2; a3 <= 2; a3 += 1) s2[n4 + i3][o4 + a3] = -2 == i3 || 2 == i3 || -2 == a3 || 2 == a3 || 0 == i3 && 0 == a3;
          }
        }, d2 = function(t3) {
          for (var r3 = x.getBCHTypeNumber(u2), e3 = 0; e3 < 18; e3 += 1) {
            var n4 = !t3 && 1 == (r3 >> e3 & 1);
            s2[Math.floor(e3 / 3)][e3 % 3 + g2 - 8 - 3] = n4;
          }
          for (e3 = 0; e3 < 18; e3 += 1) {
            n4 = !t3 && 1 == (r3 >> e3 & 1);
            s2[e3 % 3 + g2 - 8 - 3][Math.floor(e3 / 3)] = n4;
          }
        }, v2 = function(t3, r3) {
          for (var r3 = c2 << 3 | r3, e3 = x.getBCHTypeInfo(r3), n4 = 0; n4 < 15; n4 += 1) {
            var o4 = !t3 && 1 == (e3 >> n4 & 1);
            n4 < 6 ? s2[n4][8] = o4 : n4 < 8 ? s2[n4 + 1][8] = o4 : s2[g2 - 15 + n4][8] = o4;
          }
          for (n4 = 0; n4 < 15; n4 += 1) {
            o4 = !t3 && 1 == (e3 >> n4 & 1);
            n4 < 8 ? s2[8][g2 - n4 - 1] = o4 : n4 < 9 ? s2[8][15 - n4 - 1 + 1] = o4 : s2[8][15 - n4 - 1] = o4;
          }
          s2[g2 - 8][8] = !t3;
        }, p2 = function(t3, r3) {
          for (var e3 = -1, n4 = g2 - 1, o4 = 7, i3 = 0, a3 = x.getMaskFunction(r3), u3 = g2 - 1; 0 < u3; u3 -= 2) for (6 == u3 && --u3; ; ) {
            for (var f3, l3, c3 = 0; c3 < 2; c3 += 1) null == s2[n4][u3 - c3] && (f3 = false, i3 < t3.length && (f3 = 1 == (t3[i3] >>> o4 & 1)), l3 = a3(n4, u3 - c3), s2[n4][u3 - c3] = f3 = l3 ? !f3 : f3, -1 == --o4) && (i3 += 1, o4 = 7);
            if ((n4 += e3) < 0 || g2 <= n4) {
              n4 -= e3, e3 = -e3;
              break;
            }
          }
        }, w2 = function(t3, r3) {
          for (var e3 = 0, n4 = 0, o4 = 0, i3 = new Array(r3.length), a3 = new Array(r3.length), u3 = 0; u3 < r3.length; u3 += 1) {
            var f3 = r3[u3].dataCount, l3 = r3[u3].totalCount - f3, n4 = Math.max(n4, f3), o4 = Math.max(o4, l3);
            i3[u3] = new Array(f3);
            for (var c3 = 0; c3 < i3[u3].length; c3 += 1) i3[u3][c3] = 255 & t3.getBuffer()[c3 + e3];
            e3 += f3;
            var f3 = x.getErrorCorrectPolynomial(l3), s3 = _(i3[u3], f3.getLength() - 1).mod(f3);
            a3[u3] = new Array(f3.getLength() - 1);
            for (c3 = 0; c3 < a3[u3].length; c3 += 1) {
              var g3 = c3 + s3.getLength() - a3[u3].length;
              a3[u3][c3] = 0 <= g3 ? s3.getAt(g3) : 0;
            }
          }
          for (var h3 = 0, c3 = 0; c3 < r3.length; c3 += 1) h3 += r3[c3].totalCount;
          for (var d3 = new Array(h3), v3 = 0, c3 = 0; c3 < n4; c3 += 1) for (u3 = 0; u3 < r3.length; u3 += 1) c3 < i3[u3].length && (d3[v3] = i3[u3][c3], v3 += 1);
          for (c3 = 0; c3 < o4; c3 += 1) for (u3 = 0; u3 < r3.length; u3 += 1) c3 < a3[u3].length && (d3[v3] = a3[u3][c3], v3 += 1);
          return d3;
        }, m2 = function(t3, r3, e3) {
          for (var n4 = b.getRSBlocks(t3, r3), o4 = B(), i3 = 0; i3 < e3.length; i3 += 1) {
            var a3 = e3[i3];
            o4.put(a3.getMode(), 4), o4.put(a3.getLength(), x.getLengthInBits(a3.getMode(), t3)), a3.write(o4);
          }
          for (var u3 = 0, i3 = 0; i3 < n4.length; i3 += 1) u3 += n4[i3].dataCount;
          if (o4.getLengthInBits() > 8 * u3) throw "code length overflow. (" + o4.getLengthInBits() + ">" + 8 * u3 + ")";
          for (o4.getLengthInBits() + 4 <= 8 * u3 && o4.put(0, 4); o4.getLengthInBits() % 8 != 0; ) o4.putBit(false);
          for (; ; ) {
            if (o4.getLengthInBits() >= 8 * u3) break;
            if (o4.put(f2, 8), o4.getLengthInBits() >= 8 * u3) break;
            o4.put(l2, 8);
          }
          return w2(o4, n4);
        }, y2 = (A2.addData = function(t3, r3) {
          var e3 = null;
          switch (r3 = r3 || "Byte") {
            case "Numeric":
              e3 = C(t3);
              break;
            case "Alphanumeric":
              e3 = M(t3);
              break;
            case "Byte":
              e3 = S(t3);
              break;
            case "Kanji":
              e3 = L(t3);
              break;
            default:
              throw "mode:" + r3;
          }
          h2.push(e3), n3 = null;
        }, A2.isDark = function(t3, r3) {
          if (t3 < 0 || g2 <= t3 || r3 < 0 || g2 <= r3) throw t3 + "," + r3;
          return s2[t3][r3];
        }, A2.getModuleCount = function() {
          return g2;
        }, A2.make = function() {
          if (u2 < 1) {
            for (var t3 = 1; t3 < 40; t3++) {
              for (var r3 = b.getRSBlocks(t3, c2), e3 = B(), n4 = 0; n4 < h2.length; n4++) {
                var o4 = h2[n4];
                e3.put(o4.getMode(), 4), e3.put(o4.getLength(), x.getLengthInBits(o4.getMode(), t3)), o4.write(e3);
              }
              for (var i3 = 0, n4 = 0; n4 < r3.length; n4++) i3 += r3[n4].dataCount;
              if (e3.getLengthInBits() <= 8 * i3) break;
            }
            u2 = t3;
          }
          a2(false, (() => {
            for (var t4 = 0, r4 = 0, e4 = 0; e4 < 8; e4 += 1) {
              a2(true, e4);
              var n5 = x.getLostPoint(A2);
              (0 == e4 || n5 < t4) && (t4 = n5, r4 = e4);
            }
            return r4;
          })());
        }, A2.createTableTag = function(t3, r3) {
          t3 = t3 || 2;
          for (var e3 = (e3 = (e3 = (e3 = "") + '<table style=" border-width: 0px; border-style: none;') + " border-collapse: collapse;" + (" padding: 0px; margin: " + (r3 = void 0 === r3 ? 4 * t3 : r3) + "px;")) + '"><tbody>', n4 = 0; n4 < A2.getModuleCount(); n4 += 1) {
            e3 += "<tr>";
            for (var o4 = 0; o4 < A2.getModuleCount(); o4 += 1) e3 = (e3 = (e3 = (e3 += '<td style=" border-width: 0px; border-style: none; border-collapse: collapse;') + " padding: 0px; margin: 0px; width: " + t3 + "px;") + " height: " + t3 + "px; background-color: ") + (A2.isDark(n4, o4) ? "#000000" : "#ffffff") + ';"/>';
            e3 += "</tr>";
          }
          return e3 = e3 + "</tbody></table>";
        }, A2.createSvgTag = function(t3, r3, e3, n4) {
          for (var o4, i3, a3 = {}, u3 = ("object" == typeof arguments[0] && (t3 = (a3 = arguments[0]).cellSize, r3 = a3.margin, e3 = a3.alt, n4 = a3.title), t3 = t3 || 2, r3 = void 0 === r3 ? 4 * t3 : r3, (e3 = "string" == typeof e3 ? { text: e3 } : e3 || {}).text = e3.text || null, e3.id = e3.text ? e3.id || "qrcode-description" : null, (n4 = "string" == typeof n4 ? { text: n4 } : n4 || {}).text = n4.text || null, n4.id = n4.text ? n4.id || "qrcode-title" : null, A2.getModuleCount() * t3 + 2 * r3), f3 = "l" + t3 + ",0 0," + t3 + " -" + t3 + ",0 0,-" + t3 + "z ", l3 = (l3 = (l3 = (l3 = (l3 = (l3 = (l3 = "") + '<svg version="1.1" xmlns="http://www.w3.org/2000/svg"' + (a3.scalable ? "" : ' width="' + u3 + 'px" height="' + u3 + 'px"')) + (' viewBox="0 0 ' + u3 + " " + u3 + '" ') + ' preserveAspectRatio="xMinYMin meet"') + (n4.text || e3.text ? ' role="img" aria-labelledby="' + y2([n4.id, e3.id].join(" ").trim()) + '"' : "") + ">") + (n4.text ? '<title id="' + y2(n4.id) + '">' + y2(n4.text) + "</title>" : "")) + (e3.text ? '<description id="' + y2(e3.id) + '">' + y2(e3.text) + "</description>" : "")) + '<rect width="100%" height="100%" fill="white" cx="0" cy="0"/><path d="', c3 = 0; c3 < A2.getModuleCount(); c3 += 1) for (i3 = c3 * t3 + r3, o4 = 0; o4 < A2.getModuleCount(); o4 += 1) A2.isDark(c3, o4) && (l3 += "M" + (o4 * t3 + r3) + "," + i3 + f3);
          return l3 = l3 + '" stroke="transparent" fill="black"/></svg>';
        }, A2.createDataURL = function(e3, t3) {
          e3 = e3 || 2, t3 = void 0 === t3 ? 4 * e3 : t3;
          var r3 = A2.getModuleCount() * e3 + 2 * t3, n4 = t3, o4 = r3 - t3;
          return D(r3, r3, function(t4, r4) {
            return n4 <= t4 && t4 < o4 && n4 <= r4 && r4 < o4 && (t4 = Math.floor((t4 - n4) / e3), r4 = Math.floor((r4 - n4) / e3), A2.isDark(r4, t4)) ? 0 : 1;
          });
        }, A2.createImgTag = function(t3, r3, e3) {
          t3 = t3 || 2, r3 = void 0 === r3 ? 4 * t3 : r3;
          var n4 = A2.getModuleCount() * t3 + 2 * r3, o4 = (o4 = (o4 = (o4 = (o4 = (o4 = "") + '<img src="') + A2.createDataURL(t3, r3) + '"') + ' width="' + n4) + '" height="') + n4 + '"';
          return e3 && (o4 = (o4 += ' alt="') + y2(e3) + '"'), o4 += "/>";
        }, function(t3) {
          for (var r3 = "", e3 = 0; e3 < t3.length; e3 += 1) {
            var n4 = t3.charAt(e3);
            switch (n4) {
              case "<":
                r3 += "&lt;";
                break;
              case ">":
                r3 += "&gt;";
                break;
              case "&":
                r3 += "&amp;";
                break;
              case '"':
                r3 += "&quot;";
                break;
              default:
                r3 += n4;
            }
          }
          return r3;
        });
        return A2.createASCII = function(t3, r3) {
          if ((t3 = t3 || 1) < 2) {
            var e3 = r3;
            e3 = void 0 === e3 ? 2 : e3;
            for (var n4, o4, i3, a3, u3 = +A2.getModuleCount() + 2 * e3, f3 = e3, l3 = u3 - e3, c3 = { "██": "█", "█ ": "▀", " █": "▄", "  ": " " }, s3 = { "██": "▀", "█ ": "▀", " █": " ", "  ": " " }, g3 = "", h3 = 0; h3 < u3; h3 += 2) {
              for (o4 = Math.floor(h3 - f3), i3 = Math.floor(h3 + 1 - f3), n4 = 0; n4 < u3; n4 += 1) a3 = "█", f3 <= n4 && n4 < l3 && f3 <= h3 && h3 < l3 && A2.isDark(o4, Math.floor(n4 - f3)) && (a3 = " "), f3 <= n4 && n4 < l3 && f3 <= h3 + 1 && h3 + 1 < l3 && A2.isDark(i3, Math.floor(n4 - f3)) ? a3 += " " : a3 += "█", g3 += (e3 < 1 && l3 <= h3 + 1 ? s3 : c3)[a3];
              g3 += "\n";
            }
            return u3 % 2 && 0 < e3 ? g3.substring(0, g3.length - u3 - 1) + Array(1 + u3).join("▀") : g3.substring(0, g3.length - 1);
          }
          --t3, r3 = void 0 === r3 ? 2 * t3 : r3;
          for (var d3, v3, p3, w3 = A2.getModuleCount() * t3 + 2 * r3, m3 = r3, y3 = w3 - r3, k2 = Array(t3 + 1).join("██"), x2 = Array(t3 + 1).join("  "), b2 = "", B2 = "", C2 = 0; C2 < w3; C2 += 1) {
            for (v3 = Math.floor((C2 - m3) / t3), B2 = "", d3 = 0; d3 < w3; d3 += 1) p3 = 1, B2 += (p3 = m3 <= d3 && d3 < y3 && m3 <= C2 && C2 < y3 && A2.isDark(v3, Math.floor((d3 - m3) / t3)) ? 0 : p3) ? k2 : x2;
            for (v3 = 0; v3 < t3; v3 += 1) b2 += B2 + "\n";
          }
          return b2.substring(0, b2.length - 1);
        }, A2.renderTo2dContext = function(t3, r3) {
          r3 = r3 || 2;
          for (var e3 = A2.getModuleCount(), n4 = 0; n4 < e3; n4++) for (var o4 = 0; o4 < e3; o4++) t3.fillStyle = A2.isDark(n4, o4) ? "black" : "white", t3.fillRect(n4 * r3, o4 * r3, r3, r3);
        }, A2;
      }
      function T(t2) {
        for (var r2 = 0; 0 != t2; ) r2 += 1, t2 >>>= 1;
        return r2;
      }
      function _(n3, o3) {
        if (void 0 === n3.length) throw n3.length + "/" + o3;
        var r2 = (() => {
          for (var t2 = 0; t2 < n3.length && 0 == n3[t2]; ) t2 += 1;
          for (var r3 = new Array(n3.length - t2 + o3), e2 = 0; e2 < n3.length - t2; e2 += 1) r3[e2] = n3[e2 + t2];
          return r3;
        })(), i2 = { getAt: function(t2) {
          return r2[t2];
        }, getLength: function() {
          return r2.length;
        }, multiply: function(t2) {
          for (var r3 = new Array(i2.getLength() + t2.getLength() - 1), e2 = 0; e2 < i2.getLength(); e2 += 1) for (var n4 = 0; n4 < t2.getLength(); n4 += 1) r3[e2 + n4] ^= v.gexp(v.glog(i2.getAt(e2)) + v.glog(t2.getAt(n4)));
          return _(r3, 0);
        }, mod: function(t2) {
          if (i2.getLength() - t2.getLength() < 0) return i2;
          for (var r3 = v.glog(i2.getAt(0)) - v.glog(t2.getAt(0)), e2 = new Array(i2.getLength()), n4 = 0; n4 < i2.getLength(); n4 += 1) e2[n4] = i2.getAt(n4);
          for (n4 = 0; n4 < t2.getLength(); n4 += 1) e2[n4] ^= v.gexp(v.glog(t2.getAt(n4)) + r3);
          return _(e2, 0).mod(t2);
        } };
        return i2;
      }
      function P() {
        function e2(t3) {
          a2 += String.fromCharCode(((t4) => {
            if (!(t4 < 0)) {
              if (t4 < 26) return 65 + t4;
              if (t4 < 52) return t4 - 26 + 97;
              if (t4 < 62) return t4 - 52 + 48;
              if (62 == t4) return 43;
              if (63 == t4) return 47;
            }
            throw "n:" + t4;
          })(63 & t3));
        }
        var n3 = 0, o3 = 0, i2 = 0, a2 = "", t2 = { writeByte: function(t3) {
          for (n3 = n3 << 8 | 255 & t3, o3 += 8, i2 += 1; 6 <= o3; ) e2(n3 >>> o3 - 6), o3 -= 6;
        }, flush: function() {
          if (0 < o3 && (e2(n3 << 6 - o3), o3 = n3 = 0), i2 % 3 != 0) for (var t3 = 3 - i2 % 3, r2 = 0; r2 < t3; r2 += 1) a2 += "=";
        }, toString: function() {
          return a2;
        } };
        return t2;
      }
      function j(t2, r2) {
        var n3 = t2, o3 = r2, h2 = new Array(t2 * r2), i2 = function(t3) {
          for (var r3 = 1 << t3, e2 = 1 + (1 << t3), n4 = t3 + 1, o4 = d2(), i3 = 0; i3 < r3; i3 += 1) o4.add(String.fromCharCode(i3));
          o4.add(String.fromCharCode(r3)), o4.add(String.fromCharCode(e2));
          var a2, u2, f2, t3 = m(), l2 = (a2 = t3, f2 = u2 = 0, { write: function(t4, r4) {
            if (t4 >>> r4 != 0) throw "length over";
            for (; 8 <= u2 + r4; ) a2.writeByte(255 & (t4 << u2 | f2)), r4 -= 8 - u2, t4 >>>= 8 - u2, u2 = f2 = 0;
            f2 |= t4 << u2, u2 += r4;
          }, flush: function() {
            0 < u2 && a2.writeByte(f2);
          } }), c2 = (l2.write(r3, n4), 0), s2 = String.fromCharCode(h2[c2]);
          for (c2 += 1; c2 < h2.length; ) {
            var g2 = String.fromCharCode(h2[c2]);
            c2 += 1, o4.contains(s2 + g2) ? s2 += g2 : (l2.write(o4.indexOf(s2), n4), o4.size() < 4095 && (o4.size() == 1 << n4 && (n4 += 1), o4.add(s2 + g2)), s2 = g2);
          }
          return l2.write(o4.indexOf(s2), n4), l2.write(e2, n4), l2.flush(), t3.toByteArray();
        }, d2 = function() {
          var r3 = {}, e2 = 0, n4 = { add: function(t3) {
            if (n4.contains(t3)) throw "dup key:" + t3;
            r3[t3] = e2, e2 += 1;
          }, size: function() {
            return e2;
          }, indexOf: function(t3) {
            return r3[t3];
          }, contains: function(t3) {
            return void 0 !== r3[t3];
          } };
          return n4;
        };
        return t2 = { setPixel: function(t3, r3, e2) {
          h2[r3 * n3 + t3] = e2;
        }, write: function(t3) {
          t3.writeString("GIF87a"), t3.writeShort(n3), t3.writeShort(o3), t3.writeByte(128), t3.writeByte(0), t3.writeByte(0), t3.writeByte(0), t3.writeByte(0), t3.writeByte(0), t3.writeByte(255), t3.writeByte(255), t3.writeByte(255), t3.writeString(","), t3.writeShort(0), t3.writeShort(0), t3.writeShort(n3), t3.writeShort(o3), t3.writeByte(0);
          for (var r3 = i2(2), e2 = (t3.writeByte(2), 0); 255 < r3.length - e2; ) t3.writeByte(255), t3.writeBytes(r3, e2, 255), e2 += 255;
          t3.writeByte(r3.length - e2), t3.writeBytes(r3, e2, r3.length - e2), t3.writeByte(0), t3.writeString(";");
        } };
      }
      A.stringToBytesFuncs["UTF-8"] = function(t2) {
        for (var r2 = t2, e2 = [], n3 = 0; n3 < r2.length; n3++) {
          var o3 = r2.charCodeAt(n3);
          o3 < 128 ? e2.push(o3) : o3 < 2048 ? e2.push(192 | o3 >> 6, 128 | 63 & o3) : o3 < 55296 || 57344 <= o3 ? e2.push(224 | o3 >> 12, 128 | o3 >> 6 & 63, 128 | 63 & o3) : (n3++, o3 = 65536 + ((1023 & o3) << 10 | 1023 & r2.charCodeAt(n3)), e2.push(240 | o3 >> 18, 128 | o3 >> 12 & 63, 128 | o3 >> 6 & 63, 128 | 63 & o3));
        }
        return e2;
      }, void 0 !== (r = "function" == typeof (w = function() {
        return A;
      }) ? w.apply(r, []) : w) && (t.exports = r);
    }, (t, r, e) => {
      var a = e(5), l = e(6), u = e(7), f = function(t2, r2) {
        r2.back && (t2.fillStyle = r2.back, t2.fillRect(0, 0, r2.size, r2.size));
      }, c = function(t2, r2, e2, n2, o2, i) {
        t2.is_dark(o2, i) && r2.rect(i * n2, o2 * n2, n2, n2);
      }, s = function(t2, r2, e2) {
        if (t2) {
          var n2 = 0 < e2.rounded && e2.rounded <= 100 ? l : c, o2 = t2.module_count, i = e2.size / o2, a2 = 0;
          e2.crisp && (i = Math.floor(i), a2 = Math.floor((e2.size - i * o2) / 2)), r2.translate(a2, a2), r2.beginPath();
          for (var u2 = 0; u2 < o2; u2 += 1) for (var f2 = 0; f2 < o2; f2 += 1) n2(t2, r2, e2, i, u2, f2);
          r2.fillStyle = e2.fill, r2.fill(), r2.translate(-a2, -a2);
        }
      };
      t.exports = function(t2, r2, e2) {
        var n2 = r2.ratio || a.dpr, o2 = a.create_canvas(r2.size, n2), i = o2.getContext("2d");
        return i.scale(n2, n2), n2 = t2, f(t2 = i, i = r2), s(n2, t2, i), u(t2, i), e2 ? a.canvas_to_img(o2) : o2;
      };
    }, (t) => {
      function e(t2, r2) {
        return t2.getAttribute(r2);
      }
      function n2(r2, e2) {
        return Object.keys(e2 || {}).forEach(function(t2) {
          r2.setAttribute(t2, e2[t2]);
        }), r2;
      }
      function o2(t2, r2) {
        return n2(i.createElement(t2), r2);
      }
      var r = window, i = r.document, a = "http://www.w3.org/2000/svg";
      t.exports = { dpr: r.devicePixelRatio || 1, SVG_NS: a, get_attr: e, create_el: o2, create_svg_el: function(t2, r2) {
        return n2(i.createElementNS(a, t2), r2);
      }, create_canvas: function(t2, r2) {
        r2 = o2("canvas", { width: t2 * r2, height: t2 * r2 });
        return r2.style.width = "".concat(t2, "px"), r2.style.height = "".concat(t2, "px"), r2;
      }, canvas_to_img: function(t2) {
        var r2 = o2("img", { crossOrigin: "anonymous", src: t2.toDataURL("image/png"), width: e(t2, "width"), height: e(t2, "height") });
        return r2.style.width = t2.style.width, r2.style.height = t2.style.height, r2;
      } };
    }, (t) => {
      t.exports = function(t2, r, e, n2, o2, i) {
        var a, u, f, l, c, s, g, h, d = i * n2, v = o2 * n2, p = d + n2, w = v + n2, e = 5e-3 * e.rounded * n2, n2 = t2.is_dark, t2 = o2 - 1, m = o2 + 1, y = i - 1, k = i + 1, x = n2(o2, i), b = n2(t2, y), B = n2(t2, i), t2 = n2(t2, k), C = n2(o2, k), k = n2(m, k), i = n2(m, i), m = n2(m, y), n2 = n2(o2, y), o2 = (a = r, { m: function(t3, r2) {
          return a.moveTo(t3, r2), this;
        }, l: function(t3, r2) {
          return a.lineTo(t3, r2), this;
        }, a: function() {
          return a.arcTo.apply(a, arguments), this;
        } });
        x ? (y = o2, r = d, x = v, u = p, f = w, l = e, s = !B && !C, g = !i && !C, h = !i && !n2, (c = !B && !n2) ? y.m(r + l, x) : y.m(r, x), s ? y.l(u - l, x).a(u, x, u, f, l) : y.l(u, x), g ? y.l(u, f - l).a(u, f, r, f, l) : y.l(u, f), h ? y.l(r + l, f).a(r, f, r, x, l) : y.l(r, f), c ? y.l(r, x + l).a(r, x, u, x, l) : y.l(r, x)) : (s = o2, g = d, h = v, f = p, c = w, u = e, l = B && C && t2, y = i && C && k, r = i && n2 && m, B && n2 && b && s.m(g + u, h).l(g, h).l(g, h + u).a(g, h, g + u, h, u), l && s.m(f - u, h).l(f, h).l(f, h + u).a(f, h, f - u, h, u), y && s.m(f - u, c).l(f, c).l(f, c - u).a(f, c, f - u, c, u), r && s.m(g + u, c).l(g, c).l(g, c - u).a(g, c, g + u, c, u));
      };
    }, (t) => {
      t.exports = function(t2, r) {
        var e, n2, o2, i, a, u = r.mode;
        "label" === u ? (e = t2, o2 = (n2 = r).size, i = "bold " + 0.01 * n2.mSize * o2 + "px " + n2.fontname, e.strokeStyle = n2.back, e.lineWidth = 0.01 * n2.mSize * o2 * 0.1, e.fillStyle = n2.fontcolor, e.font = i, i = e.measureText(n2.label).width, a = 0.01 * n2.mSize, i = (1 - i / o2) * n2.mPosX * 0.01 * o2, a = (1 - a) * n2.mPosY * 0.01 * o2 + 0.75 * n2.mSize * 0.01 * o2, e.strokeText(n2.label, i, a), e.fillText(n2.label, i, a)) : "image" === u && (o2 = r.size, e = r.image.naturalWidth || 1, n2 = r.image.naturalHeight || 1, e = (i = 0.01 * r.mSize) * e / n2, t2.drawImage(r.image, (1 - e) * r.mPosX * 0.01 * o2, (1 - i) * r.mPosY * 0.01 * o2, e * o2, i * o2));
      };
    }, (t, r, c) => {
      var e = c(5), s = e.SVG_NS, g = e.get_attr, h = e.create_svg_el, d = function(n2) {
        function o2(t2) {
          return Math.round(10 * t2) / 10;
        }
        function i(t2) {
          return Math.round(10 * t2) / 10 + n2.o;
        }
        return { m: function(t2, r2) {
          return n2.p += "M ".concat(i(t2), " ").concat(i(r2), " "), this;
        }, l: function(t2, r2) {
          return n2.p += "L ".concat(i(t2), " ").concat(i(r2), " "), this;
        }, a: function(t2, r2, e2) {
          return n2.p += "A ".concat(o2(e2), " ").concat(o2(e2), " 0 0 1 ").concat(i(t2), " ").concat(i(r2), " "), this;
        } };
      }, w = function(t2, r2, e2, n2, o2, i, a, u, f, l) {
        a ? t2.m(r2 + i, e2) : t2.m(r2, e2), u ? t2.l(n2 - i, e2).a(n2, e2 + i, i) : t2.l(n2, e2), f ? t2.l(n2, o2 - i).a(n2 - i, o2, i) : t2.l(n2, o2), l ? t2.l(r2 + i, o2).a(r2, o2 - i, i) : t2.l(r2, o2), a ? t2.l(r2, e2 + i).a(r2 + i, e2, i) : t2.l(r2, e2);
      }, m = function(t2, r2, e2, n2, o2, i, a, u, f, l) {
        a && t2.m(r2 + i, e2).l(r2, e2).l(r2, e2 + i).a(r2 + i, e2, i), u && t2.m(n2, e2 + i).l(n2, e2).l(n2 - i, e2).a(n2, e2 + i, i), f && t2.m(n2 - i, o2).l(n2, o2).l(n2, o2 - i).a(n2 - i, o2, i), l && t2.m(r2, o2 - i).l(r2, o2).l(r2 + i, o2).a(r2, o2 - i, i);
      }, v = function(t2, r2, e2, n2, o2, i) {
        var a = i * n2, u = o2 * n2, f = a + n2, l = u + n2, e2 = 5e-3 * e2.rounded * n2, n2 = t2.is_dark, t2 = o2 - 1, c2 = o2 + 1, s2 = i - 1, g2 = i + 1, h2 = n2(o2, i), d2 = n2(t2, s2), v2 = n2(t2, i), t2 = n2(t2, g2), p = n2(o2, g2), g2 = n2(c2, g2), i = n2(c2, i), c2 = n2(c2, s2), n2 = n2(o2, s2);
        h2 ? w(r2, a, u, f, l, e2, !v2 && !n2, !v2 && !p, !i && !p, !i && !n2) : m(r2, a, u, f, l, e2, v2 && n2 && d2, v2 && p && t2, i && p && g2, i && n2 && c2);
      };
      t.exports = function(t2, r2) {
        var e2, n2, o2, i, a, u = r2.size, f = r2.mode, l = h("svg", { xmlns: s, width: u, height: u, viewBox: "0 0 ".concat(u, " ").concat(u) });
        return l.style.width = "".concat(u, "px"), l.style.height = "".concat(u, "px"), r2.back && l.appendChild(h("rect", { x: 0, y: 0, width: u, height: u, fill: r2.back })), l.appendChild(h("path", { d: ((t3, r3) => {
          if (!t3) return "";
          for (var e3 = { p: "", o: 0 }, n3 = t3.module_count, o3 = r3.size / n3, i2 = (r3.crisp && (o3 = Math.floor(o3), e3.o = Math.floor((r3.size - o3 * n3) / 2)), d(e3)), a2 = 0; a2 < n3; a2 += 1) for (var u2 = 0; u2 < n3; u2 += 1) v(t3, i2, r3, o3, a2, u2);
          return e3.p;
        })(t2, r2), fill: r2.fill })), "label" === f ? (u = l, e2 = (t2 = r2).size, n2 = "bold " + 0.01 * t2.mSize * e2 + "px " + t2.fontname, o2 = c(5), i = t2.ratio || o2.dpr, (o2 = o2.create_canvas(e2, i).getContext("2d")).strokeStyle = t2.back, o2.lineWidth = 0.01 * t2.mSize * e2 * 0.1, o2.fillStyle = t2.fontcolor, o2.font = n2, i = o2.measureText(t2.label).width, a = 0.01 * t2.mSize, i = h("text", { x: (1 - i / e2) * t2.mPosX * 0.01 * e2, y: (1 - a) * t2.mPosY * 0.01 * e2 + 0.75 * t2.mSize * 0.01 * e2 }), Object.assign(i.style, { font: n2, fill: t2.fontcolor, "paint-order": "stroke", stroke: t2.back, "stroke-width": o2.lineWidth }), i.textContent = t2.label, u.appendChild(i)) : "image" === f && (a = l, e2 = r2.size, n2 = r2.image.naturalWidth || 1, o2 = r2.image.naturalHeight || 1, o2 = (1 - (n2 = (t2 = 0.01 * r2.mSize) * n2 / o2)) * r2.mPosX * 0.01 * e2, u = (1 - t2) * r2.mPosY * 0.01 * e2, n2 *= e2, t2 *= e2, e2 = h("image", { href: g(r2.image, "src"), x: o2, y: u, width: n2, height: t2 }), a.appendChild(e2)), l;
      };
    }], o = {}, function t(r) {
      var e = o[r];
      return void 0 === e && (e = o[r] = { exports: {} }, n[r](e, e.exports, t)), e.exports;
    }(0);
    var n, o;
  });
})(kjua_min);
var kjua_minExports = kjua_min.exports;
const kjua = /* @__PURE__ */ getDefaultExportFromCjs(kjua_minExports);
function initWhatsAppModal() {
  const modal = document.querySelector("[data-whatsapp-modal]");
  if (!modal) return;
  const url = (modal.getAttribute("data-whatsapp-modal") || "").trim();
  if (!url) return;
  const config = {
    tooltipDelay: 6e3,
    tooltipDuration: 5e3
  };
  const tooltip = document.querySelector("[data-whatsapp-modal-tooltip]");
  if (tooltip) {
    tooltip.classList.remove("is-visible");
    window.setTimeout(() => {
      tooltip.classList.add("is-visible");
      window.setTimeout(() => {
        tooltip.classList.remove("is-visible");
      }, config.tooltipDuration);
    }, config.tooltipDelay);
  }
  const svg = kjua({
    text: url,
    render: "svg",
    crisp: true,
    minVersion: 1,
    ecLevel: "M",
    size: 540,
    fill: "#000000",
    back: "#FFFFFF",
    rounded: 0
  });
  svg.removeAttribute("width");
  svg.removeAttribute("height");
  svg.removeAttribute("style");
  modal.querySelectorAll("[data-whatsapp-modal-qr-canvas]").forEach((placeholder, i) => {
    const node = i === 0 ? svg : svg.cloneNode(true);
    placeholder.appendChild(node);
  });
  document.querySelectorAll("[data-whatsapp-modal-toggle]").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      if (!modal) return;
      if (tooltip.classList.contains("is-visible")) {
        tooltip.classList.remove("is-visible");
      }
      tooltip.classList.add("is-hidden");
      const isActive = modal.getAttribute("data-whatsapp-modal-status") === "active";
      modal.setAttribute("data-whatsapp-modal-status", isActive ? "not-active" : "active");
    });
  });
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" || event.keyCode === 27) {
      if (modal) {
        modal.setAttribute("data-whatsapp-modal-status", "not-active");
      }
    }
  });
}
document.addEventListener("DOMContentLoaded", function() {
  initWhatsAppModal();
});
