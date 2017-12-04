webpackJsonp(["main"],{

/***/ "../../../../../src/$$_gendir lazy recursive":
/***/ (function(module, exports) {

function webpackEmptyAsyncContext(req) {
	// Here Promise.resolve().then() is used instead of new Promise() to prevent
	// uncatched exception popping up in devtools
	return Promise.resolve().then(function() {
		throw new Error("Cannot find module '" + req + "'.");
	});
}
webpackEmptyAsyncContext.keys = function() { return []; };
webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
module.exports = webpackEmptyAsyncContext;
webpackEmptyAsyncContext.id = "../../../../../src/$$_gendir lazy recursive";

/***/ }),

/***/ "../../../../../src/app/app-routing.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppRoutingModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__movimento_movimento_component__ = __webpack_require__("../../../../../src/app/movimento/movimento.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__cliente_cliente_component__ = __webpack_require__("../../../../../src/app/cliente/cliente.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__auth_guard__ = __webpack_require__("../../../../../src/app/auth-guard.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__("../../../router/@angular/router.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};





var routes = [
    { path: '', redirectTo: '/', pathMatch: 'full' },
    { path: 'clientes', component: __WEBPACK_IMPORTED_MODULE_1__cliente_cliente_component__["a" /* ClienteComponent */], canActivate: [__WEBPACK_IMPORTED_MODULE_2__auth_guard__["a" /* AuthGuard */]] },
    { path: 'movimentos', component: __WEBPACK_IMPORTED_MODULE_0__movimento_movimento_component__["a" /* MovimentoComponent */], canActivate: [__WEBPACK_IMPORTED_MODULE_2__auth_guard__["a" /* AuthGuard */]] }
];
var AppRoutingModule = (function () {
    function AppRoutingModule() {
    }
    return AppRoutingModule;
}());
AppRoutingModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_3__angular_core__["M" /* NgModule */])({
        exports: [__WEBPACK_IMPORTED_MODULE_4__angular_router__["b" /* RouterModule */]],
        imports: [__WEBPACK_IMPORTED_MODULE_4__angular_router__["b" /* RouterModule */].forRoot(routes)],
    })
], AppRoutingModule);

//# sourceMappingURL=app-routing.module.js.map

/***/ }),

/***/ "../../../../../src/app/app.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "body {\r\n  margin: 50px;\r\n  font-family: Roboto, 'Helvetica Neue', sans-serif;\r\n  background: #eee;\r\n  font-size: 16px;\r\n  line-height: 1.4;\r\n  -webkit-font-smoothing: antialiased;\r\n}\r\n\r\nh3 {\r\n  background-color: #cdb295;\r\n}\r\n\r\ndiv {\r\n  box-sizing: border-box;\r\n}\r\n\r\n/* .small-demo {\r\n  min-height: 128px;\r\n  padding-bottom: 40px;\r\n  display: block;\r\n  background-color: #eee;\r\n} */\r\n\r\n/* .colorNested, .colored, .coloredContainerX {\r\n  height: 200px;\r\n} */\r\n\r\n/* .taller {\r\n  height: 300px;\r\n} */\r\n\r\n/* mat-card {\r\n  background-color: white;\r\n} */\r\n\r\n/* div.coloredContainerX > div, div.colorNested > div > div {\r\n  padding: 8px;\r\n  box-shadow: 0 2px 5px 0 rgba(52, 47, 51, 0.63);\r\n  opacity: 0.9;\r\n  color: #fff;\r\n  text-align: center;\r\n}\r\n\r\ndiv.coloredContainerX > div:nth-child(1), div.colorNested > div > div:nth-child(1), div.box1 {\r\n  background-color: #009688;\r\n} */\r\n\r\n/* div.coloredContainerX > div:nth-child(2), div.colorNested > div > div:nth-child(2), div.box2 {\r\n  background-color: #3949ab;\r\n}\r\n\r\ndiv.coloredContainerX > div:nth-child(3), div.coloredChildren > div:nth-child(3),\r\ndiv.colorNested > div > div:nth-child(3), div.box3 {\r\n  background-color: #9c27b0;\r\n}\r\n\r\ndiv.coloredContainerX > div:nth-child(4), div.coloredChildren > div:nth-child(4),\r\ndiv.colorNested > div > div:nth-child(4) {\r\n  background-color: #b08752;\r\n}\r\n\r\ndiv.coloredContainerX > div:nth-child(5), div.coloredChildren > div:nth-child(5),\r\ndiv.colorNested > div > div:nth-child(5) {\r\n  background-color: #5ca6b0;\r\n}\r\n\r\ndiv.colored > div {\r\n  padding: 8px;\r\n  box-shadow: 0 2px 5px 0 rgba(52, 47, 51, 0.63);\r\n  opacity: 0.9;\r\n  color: #fff;\r\n  text-align: center;\r\n}\r\n\r\ndiv.colored > div:nth-child(1), .one {\r\n  background-color: #009688;\r\n}\r\n\r\ndiv.colored > div:nth-child(2), .two {\r\n  background-color: #3949ab;\r\n}\r\n\r\ndiv.colored > div:nth-child(3), .three {\r\n  background-color: #9c27b0;\r\n}\r\n\r\ndiv.colored > div:nth-child(4), .four {\r\n  background-color: #8bc34a;\r\n}\r\n\r\ndiv.colored > div:nth-child(5), .five {\r\n  background-color: #03a9f4;\r\n}\r\n\r\ndiv.colored > div:nth-child(6), .six {\r\n  background-color: #c9954e;\r\n}\r\n\r\ndiv.colored > div:nth-child(7), .seven {\r\n  background-color: #ff5722;\r\n} */\r\n\r\n/* .hint {\r\n  margin: 5px;\r\n  font-size: 0.9em;\r\n  color: #a3a3a3;\r\n  margin-bottom: 0;\r\n}\r\n\r\n.title {\r\n  margin: 5px;\r\n  font-size: 0.9em;\r\n  color: #5c5c5c;\r\n}\r\n\r\n.box {\r\n  border: solid 1px gray;\r\n}\r\n\r\nbutton.mat-primary {\r\n  margin-left: 25px;\r\n}\r\n\r\n.demo-content {\r\n  background-color: ghostwhite;\r\n} */\r\n\r\n/* mat-toolbar-row button {\r\n  min-width: 150px;\r\n} */\r\n\r\n/* div.colored.box.nopad > div {\r\n  padding: 0;\r\n}\r\n\r\n.intro {\r\n  margin-top: -52px;\r\n  margin-left: 15px;\r\n  color: #5c5c5c;\r\n}\r\n\r\n.blocks {\r\n  min-width: 75px;\r\n  min-height: 50px;\r\n  border-radius: 3px;\r\n}\r\n\r\n.black {\r\n  border-radius: 5px;\r\n  min-width: 75px;\r\n  min-height: 50px;\r\n  color: white;\r\n  background-color: #292929;\r\n  padding: 8px;\r\n  box-shadow: 0 2px 5px 0 rgba(52, 47, 51, 0.63);\r\n  text-align: center;\r\n}\r\n\r\n.target {\r\n  background-color: #05ffb0;\r\n  color: #310736;\r\n  cursor: pointer;\r\n}\r\n\r\n.two_h {\r\n  min-height: 100px;\r\n}\r\n\r\n.two_w {\r\n  min-width: 125px;\r\n}\r\n\r\n.four_h {\r\n  min-height: 75px;\r\n}\r\n\r\n.four_w {\r\n  min-width: 100px;\r\n}\r\n\r\n.bigger {\r\n  padding: 0 20px;\r\n  padding-bottom: 30px;\r\n} */\r\n\r\nmat-toolbar .mat-toolbar-layout mat-toolbar-row {\r\n  -webkit-box-orient: vertical;\r\n  -webkit-box-direction: normal;\r\n      -ms-flex-direction: column;\r\n          flex-direction: column;\r\n  -ms-flex-line-pack: start;\r\n      align-content: flex-start;\r\n  -webkit-box-align: start;\r\n      -ms-flex-align: start;\r\n          align-items: flex-start;\r\n  min-height: 40px;\r\n}\r\n\r\n/* .demo-content .small-demo:first-child {\r\n  margin-top: 40px;\r\n} */\r\n\r\n/* mat-card-content pre {\r\n  font-size: 12px;\r\n  white-space: pre-wrap;\r\n} */\r\n\r\n/* .fxClass-all {\r\n  font-style: italic;\r\n}\r\n\r\n.fxClass-xs {\r\n  font-size: 10px;\r\n  color: blue !important;\r\n}\r\n\r\n.fxClass-sm {\r\n  font-size: 20px;\r\n  color: lightblue !important;\r\n}\r\n\r\n.fxClass-md {\r\n  font-size: 30px;\r\n  color: orange !important;\r\n}\r\n\r\n.fxClass-md2 {\r\n  font-weight: bold;\r\n}\r\n\r\n.fxClass-lg {\r\n  font-size: 40px;\r\n  color: lightgreen !important;\r\n}\r\n\r\n.fxClass-lg2 {\r\n  text-shadow: #5c5c5c;\r\n}\r\n\r\n.fixed {\r\n  height: 275px;\r\n}\r\n\r\n.ngx-split.row-split > .ngx-split-handle .ngx-split-button {\r\n  top: 50%;\r\n  left: 50%;\r\n  cursor: col-resize;\r\n  transform: translate(-50%, -50%);\r\n}\r\n\r\n.ngx-split.column-split > .ngx-split-handle .ngx-split-button {\r\n  left: 50%;\r\n  cursor: row-resize;\r\n  top: -3px;\r\n  transform: translateX(-50%) rotate(270deg);\r\n}\r\n\r\n.ngx-split .ngx-split-area {\r\n  overflow: auto;\r\n}\r\n\r\n.ngx-split .ngx-split-handle {\r\n  position: relative;\r\n}\r\n\r\n.ngx-split .ngx-split-handle .ngx-split-button {\r\n  line-height: 0;\r\n  font-size: 32px;\r\n  position: absolute;\r\n  display: block;\r\n  padding: 0;\r\n}\r\n\r\n.card-demo mat-card,\r\n.card-demo mat-card-content {\r\n  margin-bottom: 24px;\r\n}\r\n\r\n.card-demo mat-card-footer {\r\n  left: 24px;\r\n  margin-bottom: 24px;\r\n} */\r\n\r\n/* .containerX {\r\n  border: solid 1px #b6b6b6;\r\n  box-sizing: content-box !important;\r\n}\r\n\r\n.hint {\r\n  color: #a3a3a3;\r\n  font-size: 0.9em;\r\n  margin: 5px;\r\n  margin-bottom: 0;\r\n}\r\n\r\n.forceAbove {\r\n  margin-top: -275px;\r\n}\r\n\r\n.large {\r\n  height: 200px;\r\n}\r\n\r\n.large div.one, .large div.two {\r\n  color: white;\r\n}\r\n\r\n.card-demo .mat-card-content > :last-child,\r\n.card-demo > :last-child {\r\n  margin-bottom: 6px;\r\n}\r\n\r\n.hint {\r\n  margin: 5px;\r\n  font-size: 0.9em;\r\n  color: #a3a3a3;\r\n}\r\n\r\nmat-radio-group {\r\n  padding-top: 15px;\r\n}\r\n\r\n.demo_controls {\r\n  width: 100%;\r\n  height: 200px;\r\n  margin-bottom: 25px;\r\n}\r\n\r\n.demo_controls > div {\r\n  padding-top: 15px;\r\n  color: #6c6c6c;\r\n}\r\n\r\n.demo {\r\n  margin-bottom: 60px;\r\n}\r\n\r\n.um {\r\n  background: red;\r\n  color:white;\r\n  text-transform: uppercase\r\n}\r\n\r\n.dois {\r\n  background: yellow;\r\n  color:blue;\r\nwidth:25px;\r\n}\r\n\r\n.tres {\r\n  background: blue;\r\n  color:white;\r\n  text-transform: uppercase\r\n}\r\n\r\n.quatro {\r\n  background: blueviolet;\r\n  color:white;\r\n  text-transform: uppercase\r\n}\r\n\r\n.cinco {\r\n  background: darkgreen;\r\n  color:white;\r\n  text-transform: uppercase\r\n}\r\n\r\n.um, .dois, .tres, .quatro, .cinco {\r\n  padding-top:20px;\r\n  text-align:center\r\n} */\r\n\r\n.navbar-brand {\r\n  display: inline-block;\r\n  padding-top: 0.3125rem;\r\n  padding-bottom: 0.3125rem;\r\n  margin-right: 1rem;\r\n  font-size: 1.25rem;\r\n  line-height: inherit;\r\n  white-space: nowrap;\r\n}\r\n\r\n.navbar-brand:focus, .navbar-brand:hover, .navbar-brand:visited, .navbar-brand:active, .navbar-brand:link  {\r\n  text-decoration: none;\r\n}\r\n\r\n.navbar-brand {\r\n  color: #fff;\r\n}\r\n\r\n.navbar-brand:focus, .navbar-brand:hover {\r\n  color: #fff;\r\n}\r\n\r\n.espaco {\r\n  -webkit-box-flex: 1;\r\n      -ms-flex: 1 1 auto;\r\n          flex: 1 1 auto;\r\n}\r\n\r\n.icone-direita {\r\n  padding: 0 14px;\r\n}\r\n\r\n.nav-link {\r\n  display: block;\r\n  padding: 0.5rem 1rem;\r\n}\r\n\r\n.nav-link:focus, .nav-link:hover {\r\n  text-decoration: none;\r\n}\r\n\r\n.nav-link.disabled {\r\n  color: #868e96;\r\n}\r\n/* .bounds {\r\n  background-color:#ddd;\r\n  height :800px;\r\n}\r\n\r\n.sec1 {\r\n  background: red;\r\n  color:white;\r\n  text-transform: uppercase\r\n}\r\n\r\n.sec2 {\r\n  background: yellow;\r\n  color:blue;\r\n\r\n}\r\n\r\n.sec3 {\r\n  background: blue;\r\n  color:white;\r\n  text-transform: uppercase\r\n}\r\n\r\n.sec1, .sec2, .sec3 {\r\n  padding-top:20px;\r\n  text-align:center\r\n}\r\n\r\n.content {\r\n  min-width: 300px;\r\n  height: 400px;\r\n} */\r\n/* .example-form {\r\n  min-width: 150px;\r\n  max-width: 500px;\r\n  width: 100%;\r\n}\r\n\r\n.example-full-width {\r\n  width: 100%;\r\n} */\r\n", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/app.component.html":
/***/ (function(module, exports) {

module.exports = "<mat-toolbar color=\"primary\">\n  <a class=\"navbar-brand\" href=\"#\">\n    <span>SGR </span>\n  </a>\n  <!-- Cadastros -->\n  <button mat-button [matMenuTriggerFor]=\"cadastros\" *ngIf=\"Logado\">\n    <span style=\"color: white\">Cadastros</span>\n  </button>\n  <mat-menu #cadastros=\"matMenu\" [overlapTrigger]=\"false\">\n    <button mat-menu-item [routerLink]=\"['/produtos']\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-handshake-o\"></mat-icon>\n      <span>Serviços</span>\n    </button>\n    <button mat-menu-item [routerLink]=\"['/clientes']\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-group\"></mat-icon>\n      <span>Cliente</span>\n    </button>\n    <button mat-menu-item [routerLink]=\"['/clientes']\" [matMenuTriggerFor]=\"contrato\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-book\"></mat-icon>\n      <span>Contrato</span>\n    </button>\n    <button mat-menu-item [routerLink]=\"['/produtos']\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon>\n      <span>Fornecedor</span>\n    </button>\n    <button mat-menu-item [routerLink]=\"['/produtos']\" [matMenuTriggerFor]=\"residuo\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-recycle\"></mat-icon>\n      <span>Resíduo</span>\n    </button>\n    <button mat-menu-item [routerLink]=\"['/produtos']\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-usd\"></mat-icon>\n      <span>Preço</span>\n    </button>\n  </mat-menu>\n  <!-- Contrato -->\n  <mat-menu #contrato=\"matMenu\">\n    <button mat-menu-item [routerLink]=\"['/produtos']\">\n      <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n      <span>Cliente</span>\n    </button>\n    <button mat-menu-item [routerLink]=\"['/produtos']\">\n      <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n      <span>Fornecedor</span>\n    </button>\n  </mat-menu>\n  <!-- Residuo -->\n  <mat-menu #residuo=\"matMenu\">\n      <button mat-menu-item [routerLink]=\"['/produtos']\">\n        <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n        <span>Acondicionamento</span>\n      </button>\n      <button mat-menu-item [routerLink]=\"['/produtos']\">\n        <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n        <span>Resíduos</span>\n      </button>\n      <button mat-menu-item [routerLink]=\"['/produtos']\">\n        <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n        <span>Pesagem</span>\n      </button>\n      <button mat-menu-item [routerLink]=\"['/produtos']\">\n        <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n        <span>Tipo de Resíduo</span>\n      </button>\n      <button mat-menu-item [routerLink]=\"['/produtos']\">\n        <!-- <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-truck\"></mat-icon> -->\n        <span>Tipo de Tratamento</span>\n      </button>\n    </mat-menu>\n  <!-- Processos -->\n  <button mat-button [matMenuTriggerFor]=\"processos\" *ngIf=\"Logado\">\n    <span style=\"color: white\">Processos</span>\n  </button>\n  <mat-menu #processos=\"matMenu\" [overlapTrigger]=\"false\">\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-group\"></mat-icon>\n      <span>Clientes</span>\n    </button>\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-cubes\"></mat-icon>\n      <span>Produtos</span>\n    </button>\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-exchange\"></mat-icon>\n      <span>Movimentações</span>\n    </button>\n  </mat-menu>\n  <!-- Relatórios -->\n\n  <button mat-button [matMenuTriggerFor]=\"relatorios\" *ngIf=\"Logado\">\n    <span style=\"color: white\">Relatórios</span>\n  </button>\n  <mat-menu #relatorios=\"matMenu\" [overlapTrigger]=\"false\">\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-group\"></mat-icon>\n      <span>Clientes</span>\n    </button>\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-cubes\"></mat-icon>\n      <span>Produtos</span>\n    </button>\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-exchange\"></mat-icon>\n      <span>Movimentações</span>\n    </button>\n  </mat-menu>\n  <!-- Utilitários -->\n  <button mat-button [matMenuTriggerFor]=\"utilitarios\" *ngIf=\"Logado\">\n    <span style=\"color: white\">Utilitários</span>\n  </button>\n  <mat-menu #utilitarios=\"matMenu\" [overlapTrigger]=\"false\">\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-group\"></mat-icon>\n      <span>Clientes</span>\n    </button>\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-cubes\"></mat-icon>\n      <span>Produtos</span>\n    </button>\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-exchange\"></mat-icon>\n      <span>Movimentações</span>\n    </button>\n  </mat-menu>\n  <!-- Financeiro -->\n  <button mat-button [matMenuTriggerFor]=\"financeiro\" *ngIf=\"Logado\">\n      <span style=\"color: white\">Financeiro</span>\n    </button>\n    <mat-menu #financeiro=\"matMenu\" [overlapTrigger]=\"false\">\n      <button mat-menu-item>\n        <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-group\"></mat-icon>\n        <span>Receita</span>\n      </button>\n      <button mat-menu-item>\n        <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-cubes\"></mat-icon>\n        <span>Despesa</span>\n      </button>\n    </mat-menu>\n  <span class=\"espaco\"></span>\n  <button mat-button [matMenuTriggerFor]=\"loginsistema\" *ngIf=\"Logado\">\n    <i class=\"fa fa-user-o\" aria-hidden=\"true\"></i>\n    <span style=\"color: white\"> {{Usuario.name}}</span>\n  </button>\n  <mat-menu #loginsistema=\"matMenu\" [overlapTrigger]=\"false\">\n    <button mat-menu-item>\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-key\"></mat-icon>\n      <span>Trocar Senha</span>\n    </button>\n    <button mat-menu-item (click)=\"logOut()\">\n      <mat-icon fontSet=\"fontawesome\" fontIcon=\"fa-user-times\"></mat-icon>\n      <span>Sair</span>\n    </button>\n  </mat-menu>\n  <button mat-button *ngIf=\"!Logado\" (click)=\"openLoginDialog()\">\n    <i class=\"fa fa-hand-o-right\" aria-hidden=\"true\"></i>\n    <span style=\"color: white\">Login</span>\n  </button>\n</mat-toolbar>\n<router-outlet *ngIf=\"Logado\"></router-outlet>\n\n\n\n\n<!-- <mat-card class=\"card-demo\">\n  <mat-card-title>Layout Children with 'layout-align'</mat-card-title>\n  <mat-card-subtitle></mat-card-subtitle>\n  <mat-card-content>\n    <div class=\"containerX\">\n      <div class=\"colorNested box\" [class.taller]=\"options.direction != 'row'\">\n        <div [fxLayout]=\"options.direction\" [fxLayoutAlign]=\"layoutAlign()\" style=\"height: 100%;\">\n          <div class=\"blocks one um\">1</div>\n          <div class=\"blocks dois\" [class.two_h]=\"options.direction == 'row'\" [class.two_w]=\"options.direction != 'row'\">2\n          </div>\n          <div class=\"blocks three tres\">3</div>\n          <div class=\"blocks quatro\" [class.four_h]=\"options.direction == 'row'\" [class.four_w]=\"options.direction != 'row'\">4\n          </div>\n          <div class=\"blocks fives cinco\">5</div>\n        </div>\n      </div>\n    </div>\n  </mat-card-content>\n  <mat-card-actions fxLayout=\"row\" fxLayoutAlign=\"center\" fxHide fxHide.gt-sm=\"false\">\n    <form fxLayout=\"row\" fxLayout.xs=\"column\" fxLayoutAlign=\"space-around stretch\" class=\"demo_controls\">\n      <div>\n        <div>Layout Direction</div>\n        <mat-radio-group [(ngModel)]=\"options.direction\" name=\"direction\" fxLayout=\"column\">\n          <mat-radio-button value=\"row\">row</mat-radio-button>\n          <mat-radio-button value=\"column\">column</mat-radio-button>\n        </mat-radio-group>\n      </div>\n      <div>\n        <div>Alignment in Layout Direction ({{options.direction == 'row' ? 'horizontal' : 'vertical'}})\n        </div>\n        <mat-radio-group [(ngModel)]=\"options.mainAxis\" name=\"mainAxis\" fxLayout=\"column\">\n          <mat-radio-button value=\"\">none</mat-radio-button>\n          <mat-radio-button value=\"start\">start (default)</mat-radio-button>\n          <mat-radio-button value=\"center\">center</mat-radio-button>\n          <mat-radio-button value=\"end\">end</mat-radio-button>\n          <mat-radio-button value=\"space-around\">space-around</mat-radio-button>\n          <mat-radio-button value=\"space-between\">space-between</mat-radio-button>\n          <mat-radio-button value=\"space-evenly\">space-evenly</mat-radio-button>\n        </mat-radio-group>\n      </div>\n      <div>\n        <div>Alignment in Perpendicular Direction ({{options.direction == 'column' ? 'horizontal' : 'vertical'}})\n        </div>\n        <mat-radio-group [(ngModel)]=\"options.crossAxis\" name=\"crossAxis\" fxLayout=\"column\">\n          <mat-radio-button value=\"none\">\n            <em>none</em>\n          </mat-radio-button>\n          <mat-radio-button value=\"start\">start</mat-radio-button>\n          <mat-radio-button value=\"center\">center</mat-radio-button>\n          <mat-radio-button value=\"end\">end</mat-radio-button>\n          <mat-radio-button value=\"stretch\">stretch (default)</mat-radio-button>\n        </mat-radio-group>\n      </div>\n    </form>\n  </mat-card-actions>\n  <mat-card-footer style=\"width:95%;\">\n    <div class=\"hint forceAbove\" style=\"padding-left:50px;\">\n      &lt;div fxLayout=\"{{ options.direction }}\"\n      <span style=\"padding-left: 30px\">fxLayoutAlign=\"{{ layoutAlign() }}\"</span>\n      &gt;\n    </div>\n  </mat-card-footer>\n</mat-card>\n\n<mat-card class=\"card-demo\">\n  <mat-card-title>\n    <a href=\"\" target=\"_blank\">Layout Fill</a>\n  </mat-card-title>\n  <mat-card-subtitle>Using 'fxFill' to fill available width and height of parent container.\n  </mat-card-subtitle>\n  <mat-card-content class=\"large\">\n    <div fxLayout=\"column\" fxFill>\n      <div fxLayout fxFlex>\n        <div class=\"one\" fxFlex=\"20\" fxLayoutAlign=\"center center\"> A</div>\n        <div class=\"two\" fxFlex=\"80\" fxLayoutAlign=\"center center\"> B</div>\n      </div>\n    </div>\n  </mat-card-content>\n  <mat-card-footer class=\"bottomPad\">\n    <div class=\"hint\"></div>\n  </mat-card-footer>\n</mat-card>\n\n<mat-card class=\"card-demo\" (click)=\"toggleDirection()\">\n  <mat-card-title>'Flex' to Fill Row</mat-card-title>\n  <mat-card-subtitle>Simple row using \"flex\" on 3rd element to fill available main axis.\n  </mat-card-subtitle>\n  <mat-card-content>\n    <div class=\"containerX\">\n      <div [fxLayout]=\"direction\" (click)=\"toggleDirection()\" class=\"colored box\" style=\"cursor: pointer;\">\n        <div [fxFlex]=\"someValue\"> fxFlex=\"20\"</div>\n        <div fxFlex=\"60\"> fxFlex=\"60\"</div>\n        <div fxFlex> fxFlex</div>\n      </div>\n    </div>\n  </mat-card-content>\n  <mat-card-footer>\n    <div class=\"hint\">&lt;div fxLayout=\"{{ direction }}\" &gt;</div>\n  </mat-card-footer>\n</mat-card>\n\n<mat-card class=\"card-demo\" (click)=\"toggleDirection()\">\n  <mat-card-title>'Flex' with Layout-Wrap</mat-card-title>\n  <mat-card-subtitle>Using \"layout-wrap\" to wrap positioned items within a layout container\n  </mat-card-subtitle>\n  <mat-card-content>\n    <div class=\"containerX\">\n      <div [fxLayout]=\"direction\" fxLayoutWrap class=\"colored wrapped box\" (click)=\"toggleDirection()\" style=\"cursor: pointer;\">\n        <div fxFlex=\"30\"> fxFlex=\"30\"</div>\n        <div fxFlex=\"45\"> fxFlex=\"45\"</div>\n        <div fxFlex=\"19\"> fxFlex=\"19\"</div>\n        <div fxFlex=\"33\"> fxFlex=\"33\"</div>\n        <div fxFlex=\"67\"> fxFlex=\"67\"</div>\n        <div fxFlex=\"50\"> fxFlex=\"50\"</div>\n        <div fxFlex> fxFlex</div>\n      </div>\n    </div>\n  </mat-card-content>\n  <mat-card-footer>\n    <div class=\"hint\">&lt;div fxLayout=\"{{ direction }}\" &gt;</div>\n  </mat-card-footer>\n</mat-card> -->\n<!-- <div class=\"bounds\">\n\n  <div class=\"content\" fxLayout=\"row\" fxLayout.xs=\"column\" fxFlexFill>\n\n    <div fxFlex=\"15\" class=\"sec1\" fxFlex.xs=\"55\">\n      first-section\n    </div>\n    <div fxFlex=\"30\" class=\"sec2\">\n      second-section\n    </div>\n    <div fxFlex=\"55\" class=\"sec3\" fxFlex.xs=\"15\">\n      third-section\n    </div>\n\n  </div>\n\n</div> -->\n\n<!-- <ol>\n  <li>\n    <mat-form-field>\n      <input matInput [(ngModel)]=\"name\" placeholder=\"What's your name?\">\n    </mat-form-field>\n  </li>\n  <li>\n    <button mat-raised-button (click)=\"openDialog()\">Pick one</button>\n  </li>\n  <li *ngIf=\"animal\">\n    You chose:\n    <i>{{animal}}</i>\n  </li>\n</ol> -->\n\n<!-- <ol>\n  <li>\n    <mat-form-field>\n      <input matInput [(ngModel)]=\"name\" placeholder=\"Titulo do Formulario\">\n    </mat-form-field>\n  </li>\n  <li>\n    <button mat-raised-button (click)=\"openLoginDialog()\">Login</button>\n  </li>\n  <li *ngIf=\"login\">\n    You chose:\n    <i>{{login}}</i>\n  </li>\n</ol> -->\n\n<!-- <button mat-raised-button (click)=\"chamalogin()\">Login</button> -->\n<!-- <button mat-raised-button (click)=\"lerToken()\">Ler Token</button> -->\n\n<!-- <form class=\"example-form\">\n  <mat-form-field class=\"example-full-width\">\n    <input matInput placeholder=\"Email\" [formControl]=\"emailFormControl\">\n    <mat-error *ngIf=\"emailFormControl.hasError('pattern')\">\n      Please enter a valid email address\n    </mat-error>\n    <mat-error *ngIf=\"emailFormControl.hasError('required')\">\n      Email is <strong>required</strong>\n    </mat-error>\n  </mat-form-field>\n</form> -->\n\n<!-- <form class=\"example-form\">\n\n    <mat-form-field class=\"example-full-width\">\n      <input matInput #message maxlength=\"256\" placeholder=\"Message\">\n      <mat-hint align=\"start\"><strong>Don't disclose personal info</strong> </mat-hint>\n      <mat-hint align=\"end\">{{message.value.length}} / 256</mat-hint>\n    </mat-form-field>\n\n  </form> -->\n\n\n<!-- Copyright 2017 Google Inc. All Rights Reserved.\n      Use of this source code is governed by an MIT-style license that\n      can be found in the LICENSE file at http://angular.io/license -->\n"

/***/ }),

/***/ "../../../../../src/app/app.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__token_manager_service__ = __webpack_require__("../../../../../src/app/token-manager.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__user_service__ = __webpack_require__("../../../../../src/app/user.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__login_service__ = __webpack_require__("../../../../../src/app/login.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__login_login_component__ = __webpack_require__("../../../../../src/app/login/login.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_material__ = __webpack_require__("../../../material/esm5/material.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






// const EMAIL_REGEX = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
var DIRECTIONS = ['row', 'row-reverse', 'column', 'column-reverse'];
var AppComponent = (function () {
    function AppComponent(tokenManager, loginService, userService, dialog) {
        this.tokenManager = tokenManager;
        this.loginService = loginService;
        this.userService = userService;
        this.dialog = dialog;
        this.title = 'app';
        this.loginUrl = 'http://sgr.localhost/api/login';
        this.usersUrl = 'http://sgr.localhost/api/users';
        this.options = {
            direction: 'row',
            mainAxis: 'space-around',
            crossAxis: 'center'
        };
        this.direction = 'row';
        this.someValue = 20;
        this.mainAxis = 'space-around';
        this.crossAxis = 'center';
        if (!this.verificaLogin()) {
            // this.openLoginDialog();
            this.Logado = false;
        }
    }
    AppComponent.prototype.ngOnInit = function () {
        // this.logOut();
    };
    AppComponent.prototype.verificaLogin = function () {
        if (localStorage.getItem('Logado')) {
            this.Usuario = JSON.parse(localStorage.getItem('currentUser'));
            this.Logado = true;
            return true;
        }
        return false;
    };
    AppComponent.prototype.chamalogin = function () {
        var _this = this;
        this.loginService.Login('atxaloisio@hotmail.com', 'mestre').subscribe(function (data) {
            console.log(data);
            _this.Usuario = data.usuario;
            console.log(_this.Usuario.name);
            console.log(data.token);
            _this.getUsuarios(data.token);
        }, function (error) { return alert(error); });
    };
    // chamalogin() {
    //   this.realizaLogin().subscribe(data => {
    //     console.log(data);
    //     this.Usuario = data.usuario;
    //     console.log(this.Usuario.name);
    //     console.log(data.token);
    //     // this.getUsuarios(data.token);
    //   },
    //     error => alert(error),
    //   );
    // }
    // realizaLogin() {
    //   const headers = new Headers({
    //     'Content-Type': 'application/json',
    //     Accept: 'application/json'
    //   });
    //   const postData = {
    //     email: 'atxaloisio@hotmail.com',
    //     password: 'mestre'
    //   };
    //   return this.http.post(this.loginUrl, JSON.stringify(postData), {
    //     headers: headers
    //   })
    //     .map((res: Response) => res.json())
    //     .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
    // }
    AppComponent.prototype.getUsuarios = function (accessToken) {
        var _this = this;
        this.userService.getUsers(accessToken).subscribe(function (users) {
            _this.users = users;
            for (var index = 0; index < _this.users.length; index++) {
                var item = _this.users[index];
                console.log(item.name);
            }
        });
    };
    // getUsuarios(accessToken: string) {
    //   this.getUsers(accessToken).subscribe(users => {
    //     this.users = users;
    //     console.log(users);
    //   });
    // }
    // getUsers(accessToken: string): Observable<User[]> {
    //   const headers = new Headers({
    //     Accept: 'application/json',
    //     Authorization: 'Bearer ' + accessToken
    //   });
    //   return this.http
    //     .get(this.usersUrl, {
    //       headers: headers
    //     })
    //     .map((res: Response) => res.json())
    //     .catch((error: any) =>
    //       Observable.throw(error.json().error || 'Server error')
    //     );
    // }
    // openDialog(): void {
    //   let dialogRef = this.dialog.open(DialogOverviewComponent, {
    //     width: '250px',
    //     disableClose: true,
    //     data: { name: this.name, animal: this.animal }
    //   });
    //   dialogRef.afterClosed().subscribe(result => {
    //     console.log('The dialog was closed');
    //     this.animal = result;
    //   });
    // }
    AppComponent.prototype.openLoginDialog = function () {
        var _this = this;
        var dialogLoginRef = this.dialog.open(__WEBPACK_IMPORTED_MODULE_3__login_login_component__["a" /* LoginComponent */], {
            width: '500px',
            height: '320px',
            disableClose: true,
            data: { email: '', password: '' }
        });
        dialogLoginRef.afterClosed().subscribe(function (result) {
            console.log('The dialog was closed');
            if ((result.Usuario != null) || (result.Usuario !== undefined)) {
                _this.Usuario = result.Usuario;
                _this.Logado = result.logado;
                _this.tokenManager.store(result.token);
                localStorage.setItem('currentUser', JSON.stringify(_this.Usuario));
                localStorage.setItem('Logado', JSON.stringify({ Logado: _this.Logado }));
            }
        });
    };
    AppComponent.prototype.logOut = function () {
        this.Logado = false;
        this.tokenManager.delete();
        localStorage.removeItem('Logado');
        localStorage.removeItem('currentUser');
    };
    AppComponent.prototype.layoutAlign = function () {
        return this.options.mainAxis + " " + this.options.crossAxis;
    };
    AppComponent.prototype.layoutAlign2 = function () {
        return this.mainAxis + " " + this.crossAxis;
    };
    AppComponent.prototype.toggleDirection = function () {
        var next = (DIRECTIONS.indexOf(this.direction) + 1) % DIRECTIONS.length;
        this.direction = DIRECTIONS[next];
    };
    AppComponent.prototype.lerToken = function () {
        alert(this.tokenManager.retrieve());
    };
    return AppComponent;
}());
AppComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_4__angular_core__["o" /* Component */])({
        selector: 'app-root',
        template: __webpack_require__("../../../../../src/app/app.component.html"),
        styles: [__webpack_require__("../../../../../src/app/app.component.css")]
    }),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__token_manager_service__["a" /* TokenManagerService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_0__token_manager_service__["a" /* TokenManagerService */]) === "function" && _a || Object, typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_2__login_service__["a" /* LoginService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__login_service__["a" /* LoginService */]) === "function" && _b || Object, typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_1__user_service__["a" /* UserService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__user_service__["a" /* UserService */]) === "function" && _c || Object, typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_5__angular_material__["i" /* MatDialog */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_5__angular_material__["i" /* MatDialog */]) === "function" && _d || Object])
], AppComponent);

var _a, _b, _c, _d;
//# sourceMappingURL=app.component.js.map

/***/ }),

/***/ "../../../../../src/app/app.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__auth_guard__ = __webpack_require__("../../../../../src/app/auth-guard.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__token_manager_service__ = __webpack_require__("../../../../../src/app/token-manager.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__user_service__ = __webpack_require__("../../../../../src/app/user.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__login_service__ = __webpack_require__("../../../../../src/app/login.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_platform_browser__ = __webpack_require__("../../../platform-browser/@angular/platform-browser.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__app_component__ = __webpack_require__("../../../../../src/app/app.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__my_material_my_material_module__ = __webpack_require__("../../../../../src/app/my-material/my-material.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__angular_platform_browser_animations__ = __webpack_require__("../../../platform-browser/@angular/platform-browser/animations.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__angular_forms__ = __webpack_require__("../../../forms/@angular/forms.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__angular_http__ = __webpack_require__("../../../http/@angular/http.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__angular_material__ = __webpack_require__("../../../material/esm5/material.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__angular_flex_layout__ = __webpack_require__("../../../flex-layout/index.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__login_login_component__ = __webpack_require__("../../../../../src/app/login/login.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__angular_common__ = __webpack_require__("../../../common/@angular/common.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__app_routing_module__ = __webpack_require__("../../../../../src/app/app-routing.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__cliente_cliente_component__ = __webpack_require__("../../../../../src/app/cliente/cliente.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__movimento_movimento_component__ = __webpack_require__("../../../../../src/app/movimento/movimento.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__produto_produto_module__ = __webpack_require__("../../../../../src/app/produto/produto.module.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};



















var AppModule = (function () {
    function AppModule() {
    }
    return AppModule;
}());
AppModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_5__angular_core__["M" /* NgModule */])({
        declarations: [
            __WEBPACK_IMPORTED_MODULE_6__app_component__["a" /* AppComponent */],
            __WEBPACK_IMPORTED_MODULE_13__login_login_component__["a" /* LoginComponent */],
            __WEBPACK_IMPORTED_MODULE_16__cliente_cliente_component__["a" /* ClienteComponent */],
            __WEBPACK_IMPORTED_MODULE_17__movimento_movimento_component__["a" /* MovimentoComponent */]
        ],
        imports: [
            __WEBPACK_IMPORTED_MODULE_12__angular_flex_layout__["FlexLayoutModule"],
            __WEBPACK_IMPORTED_MODULE_4__angular_platform_browser__["a" /* BrowserModule */],
            __WEBPACK_IMPORTED_MODULE_8__angular_platform_browser_animations__["a" /* BrowserAnimationsModule */],
            __WEBPACK_IMPORTED_MODULE_9__angular_forms__["d" /* FormsModule */],
            __WEBPACK_IMPORTED_MODULE_10__angular_http__["c" /* HttpModule */],
            __WEBPACK_IMPORTED_MODULE_7__my_material_my_material_module__["a" /* MyMaterialModule */],
            __WEBPACK_IMPORTED_MODULE_11__angular_material__["s" /* MatNativeDateModule */],
            __WEBPACK_IMPORTED_MODULE_9__angular_forms__["i" /* ReactiveFormsModule */],
            __WEBPACK_IMPORTED_MODULE_14__angular_common__["b" /* CommonModule */],
            __WEBPACK_IMPORTED_MODULE_18__produto_produto_module__["a" /* ProdutoModule */],
            __WEBPACK_IMPORTED_MODULE_15__app_routing_module__["a" /* AppRoutingModule */]
        ],
        providers: [__WEBPACK_IMPORTED_MODULE_3__login_service__["a" /* LoginService */], __WEBPACK_IMPORTED_MODULE_2__user_service__["a" /* UserService */], __WEBPACK_IMPORTED_MODULE_1__token_manager_service__["a" /* TokenManagerService */], __WEBPACK_IMPORTED_MODULE_0__auth_guard__["a" /* AuthGuard */]],
        entryComponents: [__WEBPACK_IMPORTED_MODULE_13__login_login_component__["a" /* LoginComponent */]],
        bootstrap: [__WEBPACK_IMPORTED_MODULE_6__app_component__["a" /* AppComponent */]]
    })
], AppModule);

//# sourceMappingURL=app.module.js.map

/***/ }),

/***/ "../../../../../src/app/auth-guard.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AuthGuard; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__("../../../router/@angular/router.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var AuthGuard = (function () {
    function AuthGuard(router) {
        this.router = router;
    }
    AuthGuard.prototype.canActivate = function () {
        if (localStorage.getItem('currentUser')) {
            // logged in so return true
            return true;
        }
        // not logged in so redirect to login page
        //  this.router.navigate(['/login']);
        return false;
    };
    return AuthGuard;
}());
AuthGuard = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* Router */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* Router */]) === "function" && _a || Object])
], AuthGuard);

var _a;
//# sourceMappingURL=auth-guard.js.map

/***/ }),

/***/ "../../../../../src/app/cliente/cliente.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/cliente/cliente.component.html":
/***/ (function(module, exports) {

module.exports = "<p>\n  cliente works!\n</p>\n"

/***/ }),

/***/ "../../../../../src/app/cliente/cliente.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ClienteComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var ClienteComponent = (function () {
    function ClienteComponent() {
    }
    ClienteComponent.prototype.ngOnInit = function () {
    };
    return ClienteComponent;
}());
ClienteComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["o" /* Component */])({
        selector: 'app-cliente',
        template: __webpack_require__("../../../../../src/app/cliente/cliente.component.html"),
        styles: [__webpack_require__("../../../../../src/app/cliente/cliente.component.css")]
    }),
    __metadata("design:paramtypes", [])
], ClienteComponent);

//# sourceMappingURL=cliente.component.js.map

/***/ }),

/***/ "../../../../../src/app/login.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LoginService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Rx__ = __webpack_require__("../../../../rxjs/Rx.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__("../../../http/@angular/http.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var LoginService = (function () {
    function LoginService(_http) {
        this._http = _http;
        this.loginUrl = 'http://sgr.localhost/api/login';
    }
    LoginService.prototype.Login = function (_email, _password) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["a" /* Headers */]({
            'Content-Type': 'application/json',
            Accept: 'application/json'
        });
        var postData = {
            email: _email,
            password: _password
        };
        return this._http.post(this.loginUrl, JSON.stringify(postData), {
            headers: headers
        })
            .map(function (res) { return res.json(); })
            .catch(function (error) { return __WEBPACK_IMPORTED_MODULE_1_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error'); });
    };
    return LoginService;
}());
LoginService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__angular_http__["b" /* Http */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__angular_http__["b" /* Http */]) === "function" && _a || Object])
], LoginService);

var _a;
//# sourceMappingURL=login.service.js.map

/***/ }),

/***/ "../../../../../src/app/login/login.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "hr {\r\n  display: block;\r\n  background-color:rgb(248, 248, 248);\r\n  margin-top: 0;\r\n  margin-bottom: 0;\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n  border-style: inset;\r\n  border-width: 1.5px;\r\n  padding:0px;\r\n}\r\n\r\n.example-loading-shade {\r\n  /* position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  bottom: 56px;\r\n  right: 0; */\r\n  background: rgba(255, 255, 255, 0.15);\r\n  z-index: 1;\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-align: center;\r\n      -ms-flex-align: center;\r\n          align-items: center;\r\n  -webkit-box-pack: center;\r\n      -ms-flex-pack: center;\r\n          justify-content: center;\r\n}\r\n", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/login/login.component.html":
/***/ (function(module, exports) {

module.exports = "<h1 mat-dialog-title>Login</h1>\n<div fxLayout=\"column\" class=\"example-loading-shade\" fxLayoutAlign=\"center center\" *ngIf=\"emProcessamento\">\n  <div fxFlex=\"70\" fxFlexAlign=\"center\">\n    <mat-spinner></mat-spinner>\n  </div>\n  <div fxFlex=\"10\" fxFlexAlign=\"center\">\n    &nbsp;\n  </div>\n  <div fxFlex=\"20\" fxFlexAlign=\"center\">\n    <label>Aguarde...</label>\n  </div>\n\n\n</div>\n<div mat-dialog-content *ngIf=\"!emProcessamento\">\n  <div fxLayout=\"row\" style=\"width:100%;\" fxFill>\n    <div fxLayout=\"column\" fxFill>\n      <div fxLayout=\"row\">\n        <div fxFlex=\"20\" fxLayoutAlign=\"center center\">\n          <img src=\"assets/imagens/chave.png\" style=\"width: 100px; height: 100px;\">\n        </div>\n        <div fxFlex=\"80\" fxLayoutAlign=\"start center\">\n          <div fxLayout=\"column\" style=\"width: 100%;\">\n            <div fxFlex=\"100\">\n              <mat-form-field style=\"width:100%\">\n                <input matInput tabindex=\"1\" [(ngModel)]=\"data.email\" [formControl]=\"valEmail\" placeholder=\"E-Mail\" required (click)=\"setErroLogin('')\">\n                <mat-error *ngIf=\"valEmail.invalid\">{{getEmailErrorMessage()}}</mat-error>\n              </mat-form-field>\n            </div>\n            <div fxFlex=\"100\">\n              <mat-form-field style=\"width:100%\">\n                <input matInput tabindex=\"2\" [(ngModel)]=\"data.password\" [formControl]=\"valPassword\" placeholder=\"Senha\" required [type]=\"hide ? 'password' : 'text'\">\n                <mat-icon matSuffix (click)=\"hide = !hide\">{{hide? 'visibility' : 'visibility_off'}}</mat-icon>\n                <mat-error *ngIf=\"valPassword.invalid\">{{getPasswordErrorMessage()}}</mat-error>\n              </mat-form-field>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</div>\n<div mat-dialog-actions *ngIf=\"!emProcessamento\">\n  <div fxLayout=\"row\" fxLayoutAlign=\"end center\" fxFill>\n    <button mat-raised-button color=\"primary\" (click)=\"onEntrarClick(data)\" tabindex=\"2\" style=\"width: 50%\" [disabled]=\"(!(valEmail.valid && valPassword.valid))||(emProcessamento)\">Entrar</button>\n    <button mat-raised-button color=\"primary\" (click)=\"onNoClick()\" tabindex=\"-1\" style=\"width: 50%\">Cancelar</button>\n  </div>\n  <div fxLayout=\"row\" fxLayoutAlign=\"center center\" fxFill>\n    <mat-error *ngIf=\"erroLogin\">{{msgErroLogin}}</mat-error>\n    &nbsp;\n  </div>\n  <div fxLayout=\"row\" fxLayoutAlign=\"center center\" fxFill>\n    <a href=\"#\">Esquecia a senha</a>\n  </div>\n</div>\n"

/***/ }),

/***/ "../../../../../src/app/login/login.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return LoginComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__login_service__ = __webpack_require__("../../../../../src/app/login.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_util__ = __webpack_require__("../../../../util/util.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_util___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_util__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_material__ = __webpack_require__("../../../material/esm5/material.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_forms__ = __webpack_require__("../../../forms/@angular/forms.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var __param = (this && this.__param) || function (paramIndex, decorator) {
    return function (target, key) { decorator(target, key, paramIndex); }
};





var LoginComponent = (function () {
    function LoginComponent(loginService, dialogLoginRef, data) {
        this.loginService = loginService;
        this.dialogLoginRef = dialogLoginRef;
        this.data = data;
        this.hide = true;
        this.msgErroLogin = '';
        this.emProcessamento = false;
        this.valEmail = new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["b" /* FormControl */]('', [__WEBPACK_IMPORTED_MODULE_4__angular_forms__["j" /* Validators */].email, __WEBPACK_IMPORTED_MODULE_4__angular_forms__["j" /* Validators */].required]);
        this.valPassword = new __WEBPACK_IMPORTED_MODULE_4__angular_forms__["b" /* FormControl */]('', [__WEBPACK_IMPORTED_MODULE_4__angular_forms__["j" /* Validators */].required]);
    }
    LoginComponent.prototype.ngOnInit = function () {
    };
    LoginComponent.prototype.onEntrarClick = function () {
        var _this = this;
        this.data.logado = false;
        var mensagem = '';
        this.emProcessamento = true;
        if (Object(__WEBPACK_IMPORTED_MODULE_1_util__["isNullOrUndefined"])(this.data.email)) {
            mensagem = 'e-mail do usuário não informado.';
        }
        if (Object(__WEBPACK_IMPORTED_MODULE_1_util__["isNullOrUndefined"])(this.data.password)) {
            if (!Object(__WEBPACK_IMPORTED_MODULE_1_util__["isNullOrUndefined"])(mensagem)) {
                mensagem = mensagem + '/n';
            }
            mensagem = mensagem + 'e-mail do usuário não informado.';
        }
        if ((!Object(__WEBPACK_IMPORTED_MODULE_1_util__["isNullOrUndefined"])(this.data.email)) &&
            (!Object(__WEBPACK_IMPORTED_MODULE_1_util__["isNullOrUndefined"])(this.data.password))) {
            this.loginService.Login(this.data.email, this.data.password).subscribe(function (data) {
                // console.log(data);
                _this.data.Usuario = data.usuario;
                // console.log(this.Usuario.name);
                // console.log(data.token);
                // this.getUsuarios(data.token);
                _this.data.token = data.token;
                _this.data.logado = data.logado;
                _this.dialogLoginRef.close(_this.data);
            }, function (error) { return _this.setErroLogin(error); });
        }
    };
    LoginComponent.prototype.setErroLogin = function (erro) {
        this.msgErroLogin = erro;
        this.erroLogin = true;
        this.emProcessamento = false;
    };
    LoginComponent.prototype.onNoClick = function () {
        this.data.Usuario = null;
        this.data.token = '';
        this.data.logado = false;
        this.dialogLoginRef.close(this.data);
    };
    LoginComponent.prototype.getEmailErrorMessage = function () {
        var mensagem = '';
        if (this.valEmail.hasError('required')) {
            mensagem = 'Campo e-mail não informado.';
        }
        if (mensagem === '') {
            if (this.valEmail.hasError('email')) {
                mensagem = 'e-mail inválido.';
            }
        }
        return mensagem;
    };
    LoginComponent.prototype.getPasswordErrorMessage = function () {
        var mensagem = '';
        if (this.valPassword.hasError('required')) {
            mensagem = mensagem + 'Campo senha não informado.';
        }
        return mensagem;
    };
    return LoginComponent;
}());
LoginComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_2__angular_core__["o" /* Component */])({
        selector: 'app-login',
        template: __webpack_require__("../../../../../src/app/login/login.component.html"),
        styles: [__webpack_require__("../../../../../src/app/login/login.component.css")]
    }),
    __param(2, Object(__WEBPACK_IMPORTED_MODULE_2__angular_core__["B" /* Inject */])(__WEBPACK_IMPORTED_MODULE_3__angular_material__["a" /* MAT_DIALOG_DATA */])),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__login_service__["a" /* LoginService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_0__login_service__["a" /* LoginService */]) === "function" && _a || Object, typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_3__angular_material__["k" /* MatDialogRef */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_3__angular_material__["k" /* MatDialogRef */]) === "function" && _b || Object, Object])
], LoginComponent);

var _a, _b;
//# sourceMappingURL=login.component.js.map

/***/ }),

/***/ "../../../../../src/app/movimento/movimento.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/movimento/movimento.component.html":
/***/ (function(module, exports) {

module.exports = "<p>\n  movimento works!\n</p>\n"

/***/ }),

/***/ "../../../../../src/app/movimento/movimento.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MovimentoComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var MovimentoComponent = (function () {
    function MovimentoComponent() {
    }
    MovimentoComponent.prototype.ngOnInit = function () {
    };
    return MovimentoComponent;
}());
MovimentoComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["o" /* Component */])({
        selector: 'app-movimento',
        template: __webpack_require__("../../../../../src/app/movimento/movimento.component.html"),
        styles: [__webpack_require__("../../../../../src/app/movimento/movimento.component.css")]
    }),
    __metadata("design:paramtypes", [])
], MovimentoComponent);

//# sourceMappingURL=movimento.component.js.map

/***/ }),

/***/ "../../../../../src/app/my-material/my-material.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MyMaterialModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_material__ = __webpack_require__("../../../material/esm5/material.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_cdk_table__ = __webpack_require__("../../../cdk/esm5/table.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var MyMaterialModule = (function () {
    function MyMaterialModule(matIconRegistry) {
        matIconRegistry.registerFontClassAlias('fontawesome', 'fa');
    }
    return MyMaterialModule;
}());
MyMaterialModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["M" /* NgModule */])({
        exports: [
            __WEBPACK_IMPORTED_MODULE_2__angular_cdk_table__["m" /* CdkTableModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["b" /* MatAutocompleteModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["c" /* MatButtonModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["d" /* MatButtonToggleModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["e" /* MatCardModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["f" /* MatCheckboxModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["g" /* MatChipsModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["G" /* MatStepperModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["h" /* MatDatepickerModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["j" /* MatDialogModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["l" /* MatExpansionModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["m" /* MatGridListModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["n" /* MatIconModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["p" /* MatInputModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["q" /* MatListModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["r" /* MatMenuModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["s" /* MatNativeDateModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["u" /* MatPaginatorModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["v" /* MatProgressBarModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["w" /* MatProgressSpinnerModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["x" /* MatRadioModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["y" /* MatRippleModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["z" /* MatSelectModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["A" /* MatSidenavModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["C" /* MatSliderModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["B" /* MatSlideToggleModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["D" /* MatSnackBarModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["F" /* MatSortModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["H" /* MatTableModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["I" /* MatTabsModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["J" /* MatToolbarModule */],
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["K" /* MatTooltipModule */],
        ],
        providers: [
            __WEBPACK_IMPORTED_MODULE_1__angular_material__["o" /* MatIconRegistry */]
        ]
    }),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__angular_material__["o" /* MatIconRegistry */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__angular_material__["o" /* MatIconRegistry */]) === "function" && _a || Object])
], MyMaterialModule);

var _a;
//# sourceMappingURL=my-material.module.js.map

/***/ }),

/***/ "../../../../../src/app/produto/dsproduto.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return DsProduto; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_cdk_collections__ = __webpack_require__("../../../cdk/esm5/collections.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Observable__ = __webpack_require__("../../../../rxjs/Observable.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Observable___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_rxjs_Observable__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_startWith__ = __webpack_require__("../../../../rxjs/add/operator/startWith.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_startWith___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_startWith__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_observable_merge__ = __webpack_require__("../../../../rxjs/add/observable/merge.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_observable_merge___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_add_observable_merge__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_add_observable_fromEvent__ = __webpack_require__("../../../../rxjs/add/observable/fromEvent.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_add_observable_fromEvent___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_rxjs_add_observable_fromEvent__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__ = __webpack_require__("../../../../rxjs/add/operator/map.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_distinctUntilChanged__ = __webpack_require__("../../../../rxjs/add/operator/distinctUntilChanged.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_distinctUntilChanged___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_distinctUntilChanged__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_rxjs_add_operator_debounceTime__ = __webpack_require__("../../../../rxjs/add/operator/debounceTime.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_rxjs_add_operator_debounceTime___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7_rxjs_add_operator_debounceTime__);
var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();








var DsProduto = (function (_super) {
    __extends(DsProduto, _super);
    // isRateLimitReached = false;
    function DsProduto(_tokenManager, _produtoService, _paginator, _sort) {
        var _this = _super.call(this) || this;
        _this._tokenManager = _tokenManager;
        _this._produtoService = _produtoService;
        _this._paginator = _paginator;
        _this._sort = _sort;
        _this.resultsLength = 0;
        _this.isLoadingResults = false;
        return _this;
    }
    DsProduto.prototype.connect = function () {
        var _this = this;
        var displayDataChanges = [
            this._sort.sortChange,
            this._paginator.page
        ];
        this._sort.sortChange.subscribe(function () { return _this._paginator.pageIndex = 0; });
        return __WEBPACK_IMPORTED_MODULE_1_rxjs_Observable__["Observable"].merge.apply(__WEBPACK_IMPORTED_MODULE_1_rxjs_Observable__["Observable"], displayDataChanges).startWith(null)
            .switchMap(function () {
            _this.isLoadingResults = true;
            return _this._produtoService.getProdutos(_this._tokenManager.retrieve(), _this._sort.active, _this._sort.direction, _this._paginator.pageIndex, _this._paginator.pageSize);
        })
            .map(function (data) {
            // Flip flag to show that loading has finished.
            _this.isLoadingResults = false;
            // this.isRateLimitReached = false;
            // this.resultsLength = data.total_count;
            _this.paginaInicial = 1;
            _this.paginaFinal = data.last_page;
            _this.registroDe = data.from;
            _this.registroAte = data.to;
            _this.nrRegistros = data.total;
            return data.data;
        })
            .catch(function () {
            _this.isLoadingResults = false;
            // Catch if the GitHub API has reached its rate limit. Return empty data.
            // this.isRateLimitReached = true;
            return __WEBPACK_IMPORTED_MODULE_1_rxjs_Observable__["Observable"].of([]);
        });
        // throw new Error('Method not implemented.');
    };
    DsProduto.prototype.disconnect = function () {
        // throw new Error('Method not implemented.');
    };
    return DsProduto;
}(__WEBPACK_IMPORTED_MODULE_0__angular_cdk_collections__["a" /* DataSource */]));

//# sourceMappingURL=dsproduto.js.map

/***/ }),

/***/ "../../../../../src/app/produto/produto-list.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".customHr {\r\n  width: 95%;\r\n  font-size: 1px;\r\n  color: rgba(0, 0, 0, 0);\r\n  line-height: 1px;\r\n\r\n  background-color: grey;\r\n  margin-top: -6px;\r\n  margin-bottom: 10px;\r\n}\r\n\r\n.customHrFull {\r\n  width: 100%;\r\n  font-size: 1px;\r\n  color: rgba(0, 0, 0, 0);\r\n  line-height: 1px;\r\n\r\n  background-color: grey;\r\n  margin-top: -6px;\r\n  margin-bottom: 5px;\r\n}\r\n\r\n.mat-icon-button.size-25 {\r\n  width: 25px;\r\n  height: 25px;\r\n  line-height: 25px;\r\n}\r\n\r\n/* datatable */\r\n\r\n/* Structure */\r\n.example-container {\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-orient: vertical;\r\n  -webkit-box-direction: normal;\r\n      -ms-flex-direction: column;\r\n          flex-direction: column;\r\n  min-width: 900px;\r\n}\r\n\r\n/* .example-header {\r\n  min-height: 64px;\r\n  display: flex;\r\n  align-items: center;\r\n  padding-left: 24px;\r\n  font-size: 20px;\r\n} */\r\n\r\n.example-header {\r\n  min-height: 20px;\r\n  max-height: 20px;\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-align: center;\r\n      -ms-flex-align: center;\r\n          align-items: center;\r\n  padding: 8px 24px 0;\r\n  font-size: 20px;\r\n  -webkit-box-pack: justify;\r\n      -ms-flex-pack: justify;\r\n          justify-content: space-between;\r\n  border-bottom: 1px solid transparent;\r\n}\r\n\r\n/** Selection styles */\r\n.example-selection-header {\r\n  font-size: 18px;\r\n}\r\n\r\n.mat-table {\r\n  overflow: auto;\r\n  min-height: 300px;\r\n  max-height: 440px;\r\n}\r\n\r\n.mat-header-cell .mat-sort-header-sorted {\r\n  color: black;\r\n}\r\n\r\n.mat-header-cell {\r\n  min-height: 25px;\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-align: center;\r\n      -ms-flex-align: center;\r\n          align-items: center;\r\n  padding-left: 0px;\r\n  font-size: 15px;\r\n  font-weight: bold;\r\n}\r\n\r\n.mat-header-row {\r\n  min-height: 25px;\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-align: center;\r\n      -ms-flex-align: center;\r\n          align-items: center;\r\n  padding-left: 10px;\r\n  font-size: 15px;\r\n}\r\n\r\n.mat-row {\r\n  min-height: 25px;\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-align: center;\r\n      -ms-flex-align: center;\r\n          align-items: center;\r\n  padding-left: 10px;\r\n  font-size: 15px;\r\n  font-weight: normal;\r\n}\r\n\r\nmat-row:nth-child(even) {\r\n  background-color: white;\r\n}\r\n\r\nmat-row:nth-child(odd) {\r\n  background-color: rgb(226, 221, 221);\r\n}\r\n\r\n.highlight {\r\n  background-color: rgb(3, 12, 248) !important; /* green */\r\n}\r\n\r\n/* .mat-form-field {\r\n  font-size: 14px;\r\n  flex-grow: 1;\r\n  margin-top: 8px;\r\n} */\r\n\r\n.mat-form-field {\r\n  font-size: 14px;\r\n  -webkit-box-flex: 1;\r\n      -ms-flex-positive: 1;\r\n          flex-grow: 1;\r\n  /* margin-left: 10px; */\r\n}\r\n\r\n.example-no-results {\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-pack: center;\r\n      -ms-flex-pack: center;\r\n          justify-content: center;\r\n  padding: 24px;\r\n  font-size: 12px;\r\n  font-style: italic;\r\n}\r\n\r\n/** Selection styles */\r\n.example-selection-header {\r\n  font-size: 18px;\r\n}\r\n\r\n.mat-column-select {\r\n  max-width: 54px;\r\n}\r\n\r\n.mat-column-id {\r\n  max-width: 40px;\r\n}\r\n\r\n.mat-column-codigo_produto {\r\n  max-width: 100px;\r\n}\r\n\r\n.mat-column-descricao {\r\n  max-width: 500px;\r\n}\r\n\r\n.mat-column-unidade {\r\n  max-width: 80px;\r\n}\r\n\r\n.mat-column-quantidade_estoque {\r\n  max-width: 150px;\r\n}\r\n\r\n.mat-row:hover, .example-selected-row {\r\n  background: #f5f5f5;\r\n}\r\n\r\n.mat-row:active, .mat-row.example-selected-row {\r\n  background: #eaeaea;\r\n}\r\n\r\n.example-loading-shade {\r\n  position: absolute;\r\n  top: 0;\r\n  left: 0;\r\n  bottom: 56px;\r\n  right: 0;\r\n  background: rgba(0, 0, 0, 0.15);\r\n  z-index: 1;\r\n  display: -webkit-box;\r\n  display: -ms-flexbox;\r\n  display: flex;\r\n  -webkit-box-align: center;\r\n      -ms-flex-align: center;\r\n          align-items: center;\r\n  -webkit-box-pack: center;\r\n      -ms-flex-pack: center;\r\n          justify-content: center;\r\n  width: 100%;\r\n}\r\n", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/produto/produto-list.component.html":
/***/ (function(module, exports) {

module.exports = "<!-- <mat-card style=\"background-color: rgb(255, 255, 255); margin: 2px; padding: 2px; max-height: 550px\" ng-keydown=\"\"> -->\n  <!-- <mat-card-content style=\"background-color: rgb(255, 255, 255); padding: 0\"> -->\n    <div fxLayout=\"row\" fxLayoutAlign=\"start start\" fxLayoutGap=\"1px\" style=\"background-color: rgb(255, 255, 255)\">\n      <div fxFlex=\"140px\" style=\"background-color: rgb(255, 255, 255);padding: 10px;\" fxLayoutGap=\"10px\" >\n        <div fxLayout=\"column\" fxLayoutAlign=\"space-between center\" fxLayoutGap=\"5px\" style=\"height: 100%\">\n          <div fxFlex=\"80%\" fxFlexFill style=\"background-color: rgb(255, 255, 255)\" fxFlexAlign=\"center\">\n            <button id=\"lblTitulo\" mat-raised-button style=\"width: 100%\" disabled>\n              <i class=\"fa fa-cubes\" aria-hidden=\"true\"></i>\n              <span>PRODUTOS</span>\n            </button>\n            <button id=\"btnEditar\" mat-raised-button color=\"primary\" style=\"width: 100%\" (click)=\"obterProdutos()\">\n              <mat-icon>edit</mat-icon>\n              <span>Editar</span>\n            </button>\n            <button id=\"btnIncluir\" mat-raised-button color=\"primary\" style=\"width: 100%\">\n              <mat-icon>insert_drive_file</mat-icon>\n              <span>Incluir</span>\n            </button>\n            <button id=\"btnExcluir\" mat-raised-button color=\"primary\" style=\"width: 100%\">\n              <mat-icon>delete</mat-icon>\n              <span>Excluir</span>\n            </button>\n          </div>\n          <div fxFlex=\"40px\" fxFlexFill style=\"background-color: rgb(255, 255, 255)\" fxFlexAlign=\"end\">\n\n\n              <!-- <div fxFlex=\"20%\" fxFlexFill> -->\n                <!-- <div style=\"height: 80px\"></div> -->\n                <a routerLink=\"/\" mat-raised-button color=\"primary\" style=\"width: 120px\">\n                    <mat-icon>close</mat-icon>\n                    <span>Fechar</span>\n                </a>\n                <!-- <button id=\"btnFechar\" mat-raised-button color=\"primary\" style=\"width: 120px\">\n                  <mat-icon>close</mat-icon>\n                  <span>Fechar</span>\n                </button> -->\n              <!-- </div> -->\n\n          </div>\n        </div>\n      </div>\n      <div fxFlex=\"90%\" style=\"background-color: rgb(255, 255, 255)\">\n        <div fxLayout=\"column\" fxLayoutAlign=\"center center\" fxLayoutGap=\"5px\">\n          <!-- <div fxFlex=\"35px\" fxFlexAlign=\"start\" style=\"background-color: rgb(29, 238, 221); width: 100%\" [style.display]=\"selection.isEmpty() ? '' : 'none'\">\n            <div class=\"example-header\" [style.display]=\"selection.isEmpty() ? '' : 'none'\">\n              <mat-form-field floatPlaceholder=\"never\">\n                <input matInput #filter placeholder=\"Filter users\">\n              </mat-form-field>\n            </div>\n          </div>\n          <div fxFlex=\"1px\" class=\"customHrFull\"></div>\n          <div fxFlex=\"35px\" fxFlexAlign=\"start\" style=\"background-color: rgb(29, 238, 57); width: 100%\" *ngIf=\"!selection.isEmpty()\">\n            {{selection.selected.length}} {{selection.selected.length == 1 ? 'user' : 'users'}} selected\n          </div>\n          <div fxFlex=\"1px\" class=\"customHrFull\"></div> -->\n          <div fxFlex=\"47px\" fxFlexAlign=\"start\" style=\"background-color: rgb(255, 255, 255); width: 100%\">\n            <table>\n              <tr>\n                <td>\n                    <mat-form-field class=\"mat-column-id\" style=\"margin-left: 10px\">\n                        <input matInput #filter placeholder=\"ID\">\n                      </mat-form-field>\n                </td>\n                <td>\n                    <mat-form-field class=\"mat-column-codigo_produto\">\n                        <input matInput #filter placeholder=\"Código\">\n                      </mat-form-field>\n                </td>\n                <td class=\"mat-column-descricao\" >\n                    <!-- style=\"width: 500px\" -->\n                    <mat-form-field class=\"mat-column-descricao\" >\n                        <input matInput #filter placeholder=\"Descrição\">\n                      </mat-form-field>\n                </td>\n                <td>\n                    <mat-form-field class=\"mat-column-unidade\">\n                        <input matInput #filter placeholder=\"Unidade\">\n                      </mat-form-field>\n                </td>\n                <td>\n                    <mat-form-field class=\"mat-column-quantidade_estoque\">\n                        <input matInput #filter placeholder=\"Quantidade Estoque\">\n                      </mat-form-field>\n\n                </td>\n              </tr>\n            </table>\n          </div>\n          <div fxFlex=\"1px\" class=\"customHrFull\"></div>\n          <div fxFlex=\"400px\" class=\"example-loading-shade\" fxFlexAlign=\"start\" *ngIf=\"dataSource.isLoadingResults\">\n            <mat-spinner *ngIf=\"dataSource.isLoadingResults\"></mat-spinner>\n          </div>\n          <div fxFlex=\"400px\" fxFlexAlign=\"start\" style=\"background-color: rgb(255, 255, 255); width: 100%\">\n\n            <mat-table #table [dataSource]=\"dataSource\" matSort>\n\n              <!--- Note that these columns can be defined in any order.\n                          The actual rendered columns are set as a property on the row definition\" -->\n\n              <!-- Checkbox Column -->\n              <!-- <ng-container matColumnDef=\"select\">\n                <mat-header-cell *matHeaderCellDef>\n                  <mat-checkbox (change)=\"$event ? masterToggle() : null\" [checked]=\"isAllSelected()\" [indeterminate]=\"selection.hasValue() && !isAllSelected()\">\n                  </mat-checkbox>\n                </mat-header-cell>\n                <mat-cell *matCellDef=\"let row\">\n                  <mat-checkbox (click)=\"$event.stopPropagation()\" (change)=\"$event ? selection.toggle(row.id) : null\" [checked]=\"selection.isSelected(row.id)\">\n                  </mat-checkbox>\n                </mat-cell>\n              </ng-container> -->\n\n              <!-- ID Column -->\n              <ng-container matColumnDef=\"id\">\n                <mat-header-cell *matHeaderCellDef mat-sort-header> ID </mat-header-cell>\n                <mat-cell *matCellDef=\"let row\"> {{row.id}} </mat-cell>\n              </ng-container>\n\n              <!-- Progress Column -->\n              <ng-container matColumnDef=\"codigo_produto\">\n                <mat-header-cell *matHeaderCellDef mat-sort-header> Código </mat-header-cell>\n                <mat-cell *matCellDef=\"let row\"> {{row.codigo_produto}} </mat-cell>\n              </ng-container>\n\n              <!-- Name Column -->\n              <ng-container matColumnDef=\"descricao\">\n                <mat-header-cell *matHeaderCellDef mat-sort-header> Descrição </mat-header-cell>\n                <mat-cell *matCellDef=\"let row\"> {{row.descricao}} </mat-cell>\n              </ng-container>\n\n              <!-- Color Column -->\n              <ng-container matColumnDef=\"unidade\">\n                <mat-header-cell *matHeaderCellDef mat-sort-header> Unidade </mat-header-cell>\n                <mat-cell *matCellDef=\"let row\"> {{row.unidade}} </mat-cell>\n              </ng-container>\n\n              <!-- Color Column -->\n              <ng-container matColumnDef=\"quantidade_estoque\">\n                <mat-header-cell *matHeaderCellDef mat-sort-header> Quantidade Estoque </mat-header-cell>\n                <mat-cell *matCellDef=\"let row\"> {{row.quantidade_estoque}} </mat-cell>\n              </ng-container>\n\n\n              <mat-header-row *matHeaderRowDef=\"displayedColumns\"></mat-header-row>\n              <mat-row *matRowDef=\"let row; columns: displayedColumns;\" [ngClass]=\"{'highlight': selectedRowIndex == row.id}\" (click)=\"highlight(row)\"></mat-row>\n            </mat-table>\n            <mat-paginator #paginator [length]=\"dataSource.nrRegistros\" [pageIndex]=\"1\" [pageSize]=\"25\" [pageSizeOptions]=\"[5, 10, 15, 25, 100]\">\n            </mat-paginator>\n          </div>\n        </div>\n      </div>\n    </div>\n  <!-- </mat-card-content> -->\n<!-- </mat-card> -->\n"

/***/ }),

/***/ "../../../../../src/app/produto/produto-list.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProdutoListComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__dsproduto__ = __webpack_require__("../../../../../src/app/produto/dsproduto.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__token_manager_service__ = __webpack_require__("../../../../../src/app/token-manager.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__produto_service__ = __webpack_require__("../../../../../src/app/produto/produto.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_material__ = __webpack_require__("../../../material/esm5/material.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_cdk_collections__ = __webpack_require__("../../../cdk/esm5/collections.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_startWith__ = __webpack_require__("../../../../rxjs/add/operator/startWith.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_startWith___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6_rxjs_add_operator_startWith__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_rxjs_add_observable_merge__ = __webpack_require__("../../../../rxjs/add/observable/merge.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7_rxjs_add_observable_merge___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7_rxjs_add_observable_merge__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8_rxjs_add_observable_fromEvent__ = __webpack_require__("../../../../rxjs/add/observable/fromEvent.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8_rxjs_add_observable_fromEvent___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8_rxjs_add_observable_fromEvent__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9_rxjs_add_operator_map__ = __webpack_require__("../../../../rxjs/add/operator/map.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_9_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10_rxjs_add_operator_distinctUntilChanged__ = __webpack_require__("../../../../rxjs/add/operator/distinctUntilChanged.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10_rxjs_add_operator_distinctUntilChanged___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_10_rxjs_add_operator_distinctUntilChanged__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11_rxjs_add_operator_debounceTime__ = __webpack_require__("../../../../rxjs/add/operator/debounceTime.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11_rxjs_add_operator_debounceTime___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_11_rxjs_add_operator_debounceTime__);
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};













var ProdutoListComponent = (function () {
    // @ViewChild('filter') filter: ElementRef;
    // isAllSelected(): boolean {
    //   if (!this.dataSource) { return false; }
    //   if (this.selection.isEmpty()) { return false; }
    //   if (this.filter.nativeElement.value) {
    //     return this.selection.selected.length === this.dataSource.renderedData.length;
    //   } else {
    //     return this.selection.selected.length === this.exampleDatabase.data.length;
    //   }
    // }
    // masterToggle() {
    //   if (!this.dataSource) { return; }
    //   if (this.isAllSelected()) {
    //     this.selection.clear();
    //   } else if (this.filter.nativeElement.value) {
    //     this.dataSource.renderedData.forEach(data => this.selection.select(data.id));
    //   } else {
    //     this.exampleDatabase.data.forEach(data => this.selection.select(data.id));
    //   }
    // }
    function ProdutoListComponent(_produtoService, _tokenManager) {
        this._produtoService = _produtoService;
        this._tokenManager = _tokenManager;
        this.pagina = 1;
        this.totalPagina = 10;
        // displayedColumns = ['select', 'userId', 'userName', 'progress', 'color'];
        this.displayedColumns = ['id', 'codigo_produto', 'descricao', 'unidade', 'quantidade_estoque'];
        // exampleDatabase = new ExampleDatabase();
        this.selection = new __WEBPACK_IMPORTED_MODULE_5__angular_cdk_collections__["b" /* SelectionModel */](true, []);
        this.selectedRowIndex = -1;
    }
    ProdutoListComponent.prototype.obterProdutos = function () {
        // const token = this._tokenManager.retrieve();
        // this._produtoService.getProdutos(token).subscribe(data => {
        //   this.produtos = data.data;
        //   console.log(data);
        //   console.log(this.produtos.length);
        //   console.log(token);
        // });
    };
    ProdutoListComponent.prototype.highlight = function (row) {
        if (this.selectedRowIndex === row.id) {
            this.selectedRowIndex = -1;
        }
        else {
            this.selectedRowIndex = row.id;
        }
        // alert('clicou na linha ' + row.id);
    };
    //#region botões de ação
    ProdutoListComponent.prototype.btnEditar_click = function () {
        alert('Editar');
    };
    ProdutoListComponent.prototype.btnIncluir_click = function () {
        alert('Incluir');
    };
    ProdutoListComponent.prototype.btnExcluir_click = function () {
        alert('Excluir');
    };
    //#endregion
    //#region botoes navegação
    ProdutoListComponent.prototype.btnPrimeiro_click = function () {
        alert('primeiro');
    };
    ProdutoListComponent.prototype.btnAnterior_click = function () {
        alert('anterior');
    };
    ProdutoListComponent.prototype.btnProximo_click = function () {
        alert('proximo');
    };
    ProdutoListComponent.prototype.btnUltimo_click = function () {
        alert('ultimo');
    };
    //#endregion
    ProdutoListComponent.prototype.ngOnInit = function () {
        // this.dataSource = new ExampleDataSource(this.exampleDatabase, this.sort);
        this.paginator._intl.itemsPerPageLabel = 'Itens por pagina';
        this.paginator._intl.nextPageLabel = 'Próxima Página';
        this.paginator._intl.previousPageLabel = 'Voltar Página';
        this.dataSource = new __WEBPACK_IMPORTED_MODULE_0__dsproduto__["a" /* DsProduto */](this._tokenManager, this._produtoService, this.paginator, this.sort);
        // this.dataSource = new ExampleDataSource(this.exampleDatabase, this.paginator, this.sort);
        // Observable.fromEvent(this.filter.nativeElement, 'keyup')
        //     .debounceTime(150)
        //     .distinctUntilChanged()
        //     .subscribe(() => {
        //       if (!this.dataSource) { return; }
        //       this.dataSource.filter = this.filter.nativeElement.value;
        //     });
    };
    return ProdutoListComponent;
}());
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_3__angular_core__["_17" /* ViewChild */])(__WEBPACK_IMPORTED_MODULE_4__angular_material__["E" /* MatSort */]),
    __metadata("design:type", typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_4__angular_material__["E" /* MatSort */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_4__angular_material__["E" /* MatSort */]) === "function" && _a || Object)
], ProdutoListComponent.prototype, "sort", void 0);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_3__angular_core__["_17" /* ViewChild */])(__WEBPACK_IMPORTED_MODULE_4__angular_material__["t" /* MatPaginator */]),
    __metadata("design:type", typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_4__angular_material__["t" /* MatPaginator */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_4__angular_material__["t" /* MatPaginator */]) === "function" && _b || Object)
], ProdutoListComponent.prototype, "paginator", void 0);
ProdutoListComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_3__angular_core__["o" /* Component */])({
        selector: 'app-produto',
        template: __webpack_require__("../../../../../src/app/produto/produto-list.component.html"),
        styles: [__webpack_require__("../../../../../src/app/produto/produto-list.component.css")]
    }),
    __metadata("design:paramtypes", [typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_2__produto_service__["a" /* ProdutoService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__produto_service__["a" /* ProdutoService */]) === "function" && _c || Object, typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_1__token_manager_service__["a" /* TokenManagerService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__token_manager_service__["a" /* TokenManagerService */]) === "function" && _d || Object])
], ProdutoListComponent);

var _a, _b, _c, _d;
/** Constants used to fill up our data base. */
// const COLORS = ['maroon', 'red', 'orange', 'yellow', 'olive', 'green', 'purple',
// 'fuchsia', 'lime', 'teal', 'aqua', 'blue', 'navy', 'black', 'gray'];
// const NAMES = ['Maia', 'Asher', 'Olivia', 'Atticus', 'Amelia', 'Jack',
// 'Charlotte', 'Theodore', 'Isla', 'Oliver', 'Isabella', 'Jasper',
// 'Cora', 'Levi', 'Violet', 'Arthur', 'Mia', 'Thomas', 'Elizabeth'];
// export interface UserData {
// id: string;
// name: string;
// progress: string;
// color: string;
// }
/** An example database that the data source uses to retrieve data for the table. */
// export class ExampleDatabase {
//   /** Stream that emits whenever the data has been modified. */
//   dataChange: BehaviorSubject<UserData[]> = new BehaviorSubject<UserData[]>([]);
//   get data(): UserData[] { return this.dataChange.value; }
//   constructor() {
//     // Fill up the database with 100 users.
//     for (let i = 0; i < 100; i++) { this.addUser(); }
//   }
//   /** Adds a new user to the database. */
//   addUser() {
//     const copiedData = this.data.slice();
//     copiedData.push(this.createNewUser());
//     this.dataChange.next(copiedData);
//   }
//   /** Builds and returns a new User. */
//   private createNewUser() {
//     const name =
//         NAMES[Math.round(Math.random() * (NAMES.length - 1))] + ' ' +
//         NAMES[Math.round(Math.random() * (NAMES.length - 1))].charAt(0) + '.';
//     return {
//       id: (this.data.length + 1).toString(),
//       name: name,
//       progress: Math.round(Math.random() * 100).toString(),
//       color: COLORS[Math.round(Math.random() * (COLORS.length - 1))]
//     };
//   }
// }
/**
 * Data source to provide what data should be rendered in the table. Note that the data source
 * can retrieve its data in any way. In this case, the data source is provided a reference
 * to a common data base, ExampleDatabase. It is not the data source's responsibility to manage
 * the underlying data. Instead, it only needs to take the data and send the table exactly what
 * should be rendered.
 */
// export class ExampleDataSource extends DataSource<any> {
//   _filterChange = new BehaviorSubject('');
//   get filter(): string { return this._filterChange.value; }
//   set filter(filter: string) { this._filterChange.next(filter); }
//   filteredData: UserData[] = [];
//   renderedData: UserData[] = [];
//   constructor(private _exampleDatabase: ExampleDatabase,
//               private _paginator: MatPaginator,
//               private _sort: MatSort) {
//     super();
//     // Reset to the first page when the user changes the filter.
//     this._filterChange.subscribe(() => this._paginator.pageIndex = 0);
//   }
//   /** Connect function called by the table to retrieve one stream containing the data to render. */
//   connect(): Observable<UserData[]> {
//     // Listen for any changes in the base data, sorting, filtering, or pagination
//     const displayDataChanges = [
//       this._exampleDatabase.dataChange,
//       this._sort.sortChange,
//       this._filterChange,
//       this._paginator.page,
//     ];
//     return Observable.merge(...displayDataChanges).map(() => {
//       // Filter data
//       this.filteredData = this._exampleDatabase.data.slice().filter((item: UserData) => {
//         let searchStr = (item.name + item.color).toLowerCase();
//         return searchStr.indexOf(this.filter.toLowerCase()) != -1;
//       });
//       // Sort filtered data
//       const sortedData = this.sortData(this.filteredData.slice());
//       // Grab the page's slice of the filtered sorted data.
//       const startIndex = this._paginator.pageIndex * this._paginator.pageSize;
//       this.renderedData = sortedData.splice(startIndex, this._paginator.pageSize);
//       return this.renderedData;
//     });
//   }
//   disconnect() {}
//   /** Returns a sorted copy of the database data. */
//   sortData(data: UserData[]): UserData[] {
//     if (!this._sort.active || this._sort.direction === '') { return data; }
//     return data.sort((a, b) => {
//       let propertyA: number|string = '';
//       let propertyB: number|string = '';
//       switch (this._sort.active) {
//         case 'userId': [propertyA, propertyB] = [a.id, b.id]; break;
//         case 'userName': [propertyA, propertyB] = [a.name, b.name]; break;
//         case 'progress': [propertyA, propertyB] = [a.progress, b.progress]; break;
//         case 'color': [propertyA, propertyB] = [a.color, b.color]; break;
//       }
//       let valueA = isNaN(+propertyA) ? propertyA : +propertyA;
//       let valueB = isNaN(+propertyB) ? propertyB : +propertyB;
//       return (valueA < valueB ? -1 : 1) * (this._sort.direction === 'asc' ? 1 : -1);
//     });
//   }
// }
//# sourceMappingURL=produto-list.component.js.map

/***/ }),

/***/ "../../../../../src/app/produto/produto-routing.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProdutoRoutingModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__auth_guard__ = __webpack_require__("../../../../../src/app/auth-guard.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__produto_list_component__ = __webpack_require__("../../../../../src/app/produto/produto-list.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__("../../../router/@angular/router.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};




var routes = [
    { path: 'produtos', component: __WEBPACK_IMPORTED_MODULE_2__produto_list_component__["a" /* ProdutoListComponent */], canActivate: [__WEBPACK_IMPORTED_MODULE_0__auth_guard__["a" /* AuthGuard */]] },
];
var ProdutoRoutingModule = (function () {
    function ProdutoRoutingModule() {
    }
    return ProdutoRoutingModule;
}());
ProdutoRoutingModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_1__angular_core__["M" /* NgModule */])({
        imports: [__WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* RouterModule */].forChild(routes)],
        exports: [__WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* RouterModule */]]
    })
], ProdutoRoutingModule);

//# sourceMappingURL=produto-routing.module.js.map

/***/ }),

/***/ "../../../../../src/app/produto/produto.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProdutoModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_material__ = __webpack_require__("../../../material/esm5/material.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__my_material_my_material_module__ = __webpack_require__("../../../../../src/app/my-material/my-material.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__("../../../http/@angular/http.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_platform_browser_animations__ = __webpack_require__("../../../platform-browser/@angular/platform-browser/animations.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_platform_browser__ = __webpack_require__("../../../platform-browser/@angular/platform-browser.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_flex_layout__ = __webpack_require__("../../../flex-layout/index.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__produto_list_component__ = __webpack_require__("../../../../../src/app/produto/produto-list.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__produto_service__ = __webpack_require__("../../../../../src/app/produto/produto.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__angular_common__ = __webpack_require__("../../../common/@angular/common.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__angular_forms__ = __webpack_require__("../../../forms/@angular/forms.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__produto_routing_module__ = __webpack_require__("../../../../../src/app/produto/produto-routing.module.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};












var ProdutoModule = (function () {
    function ProdutoModule() {
    }
    return ProdutoModule;
}());
ProdutoModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_8__angular_core__["M" /* NgModule */])({
        imports: [
            __WEBPACK_IMPORTED_MODULE_9__angular_common__["b" /* CommonModule */],
            __WEBPACK_IMPORTED_MODULE_5__angular_flex_layout__["FlexLayoutModule"],
            __WEBPACK_IMPORTED_MODULE_4__angular_platform_browser__["a" /* BrowserModule */],
            __WEBPACK_IMPORTED_MODULE_3__angular_platform_browser_animations__["a" /* BrowserAnimationsModule */],
            __WEBPACK_IMPORTED_MODULE_10__angular_forms__["d" /* FormsModule */],
            __WEBPACK_IMPORTED_MODULE_2__angular_http__["c" /* HttpModule */],
            __WEBPACK_IMPORTED_MODULE_1__my_material_my_material_module__["a" /* MyMaterialModule */],
            __WEBPACK_IMPORTED_MODULE_0__angular_material__["s" /* MatNativeDateModule */],
            __WEBPACK_IMPORTED_MODULE_10__angular_forms__["i" /* ReactiveFormsModule */],
            __WEBPACK_IMPORTED_MODULE_11__produto_routing_module__["a" /* ProdutoRoutingModule */]
        ],
        declarations: [
            __WEBPACK_IMPORTED_MODULE_6__produto_list_component__["a" /* ProdutoListComponent */]
        ],
        providers: [__WEBPACK_IMPORTED_MODULE_7__produto_service__["a" /* ProdutoService */]]
    })
], ProdutoModule);

//# sourceMappingURL=produto.module.js.map

/***/ }),

/***/ "../../../../../src/app/produto/produto.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ProdutoService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_util__ = __webpack_require__("../../../../util/util.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_util___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_util__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_observable_of__ = __webpack_require__("../../../../rxjs/add/observable/of.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_observable_of___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_rxjs_add_observable_of__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_operator_map__ = __webpack_require__("../../../../rxjs/add/operator/map.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_operator_map___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_rxjs_add_operator_map__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_Rx__ = __webpack_require__("../../../../rxjs/Rx.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__angular_http__ = __webpack_require__("../../../http/@angular/http.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};






var ProdutoService = (function () {
    function ProdutoService(_http) {
        this._http = _http;
        this.produtoUrl = 'http://sgr.localhost/api/produtos';
    }
    /** Metodo que retorna um observable com dados da listagem de produtos
     *  parametro: acessToken: string
    */
    ProdutoService.prototype.getProdutos = function (accessToken, sort, order, page, pagesize) {
        var headers = new __WEBPACK_IMPORTED_MODULE_5__angular_http__["a" /* Headers */]({
            Accept: 'application/json',
            Authorization: 'Bearer ' + accessToken
        });
        var search = new __WEBPACK_IMPORTED_MODULE_5__angular_http__["d" /* URLSearchParams */]();
        search.set('nrcount', pagesize.toString());
        page++;
        search.set('page', page.toString());
        if ((!Object(__WEBPACK_IMPORTED_MODULE_0_util__["isNullOrUndefined"])(order)) && (order.length > 0)) {
            search.set('order', order);
        }
        else {
            order = 'asc';
            search.set('order', order);
        }
        if ((!Object(__WEBPACK_IMPORTED_MODULE_0_util__["isNullOrUndefined"])(sort))) {
            search.set('orderkey', sort);
        }
        else {
            sort = 'id';
            search.set('orderkey', sort);
        }
        return this._http
            .get(this.produtoUrl, { headers: headers, search: search })
            .map(function (res) { return res.json(); })
            .catch(function (error) {
            return __WEBPACK_IMPORTED_MODULE_4_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error');
        });
    };
    return ProdutoService;
}());
ProdutoService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_1__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_5__angular_http__["b" /* Http */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_5__angular_http__["b" /* Http */]) === "function" && _a || Object])
], ProdutoService);

var _a;
//# sourceMappingURL=produto.service.js.map

/***/ }),

/***/ "../../../../../src/app/token-manager.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return TokenManagerService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var TokenManagerService = (function () {
    function TokenManagerService() {
        this.tokenKey = 'app_token';
    }
    TokenManagerService.prototype.store = function (content) {
        console.log(content);
        localStorage.setItem(this.tokenKey, JSON.stringify(content));
    };
    TokenManagerService.prototype.retrieve = function () {
        var storedToken = localStorage.getItem(this.tokenKey);
        if (!storedToken) {
            throw new Error('Token não encontrado!');
        }
        return storedToken;
    };
    TokenManagerService.prototype.delete = function () {
        localStorage.removeItem(this.tokenKey);
    };
    return TokenManagerService;
}());
TokenManagerService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [])
], TokenManagerService);

//# sourceMappingURL=token-manager.service.js.map

/***/ }),

/***/ "../../../../../src/app/user.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return UserService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Rx__ = __webpack_require__("../../../../rxjs/Rx.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Rx___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_rxjs_Rx__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_http__ = __webpack_require__("../../../http/@angular/http.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var UserService = (function () {
    function UserService(_http) {
        this._http = _http;
        this.usersUrl = 'http://sgr.localhost/api/users';
    }
    UserService.prototype.getUsers = function (accessToken) {
        var headers = new __WEBPACK_IMPORTED_MODULE_2__angular_http__["a" /* Headers */]({
            Accept: 'application/json',
            Authorization: 'Bearer ' + accessToken
        });
        return this._http.get(this.usersUrl, { headers: headers })
            .map(function (res) { return res.json(); })
            .catch(function (error) {
            return __WEBPACK_IMPORTED_MODULE_1_rxjs_Rx__["Observable"].throw(error.json().error || 'Server error');
        });
    };
    return UserService;
}());
UserService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_2__angular_http__["b" /* Http */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_2__angular_http__["b" /* Http */]) === "function" && _a || Object])
], UserService);

var _a;
//# sourceMappingURL=user.service.js.map

/***/ }),

/***/ "../../../../../src/environments/environment.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return environment; });
// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `.angular-cli.json`.
// The file contents for the current environment will overwrite these during build.
var environment = {
    production: false
};
//# sourceMappingURL=environment.js.map

/***/ }),

/***/ "../../../../../src/main.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__ = __webpack_require__("../../../platform-browser-dynamic/@angular/platform-browser-dynamic.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__app_app_module__ = __webpack_require__("../../../../../src/app/app.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__environments_environment__ = __webpack_require__("../../../../../src/environments/environment.ts");




if (__WEBPACK_IMPORTED_MODULE_3__environments_environment__["a" /* environment */].production) {
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["_24" /* enableProdMode */])();
}
Object(__WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__["a" /* platformBrowserDynamic */])().bootstrapModule(__WEBPACK_IMPORTED_MODULE_2__app_app_module__["a" /* AppModule */])
    .catch(function (err) { return console.log(err); });
//# sourceMappingURL=main.js.map

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("../../../../../src/main.ts");


/***/ })

},[0]);
//# sourceMappingURL=main.bundle.js.map