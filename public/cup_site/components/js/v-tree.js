crud.conf['v-tree'] = {
    resources : [
        'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js',
    ],
}
Vue.component('v-tree',{
    extends : crud.components.views.vList,
    template : '#v-tree-template',
    methods :  {
        getPageData(id) {
            var that = this;
            for (var i in that.value) {
                //console.log('confronto',that.value[i].id,id);
                if (""+that.value[i].id == (id+"")) {
                    //console.log('pageData',that.value[i]);
                    return that.value[i];
                }
                for (var k in that.value[i].children) {
                    if (""+that.value[i].children[k].id == (id+"")) {
                        //console.log('pageData',that.value[i]);
                        return that.value[i].children[k];
                    }
                }
            }
            console.log('controllo new nodes',that.newNodes)
            for (var i in that.newNodes) {
                //console.log('confronto',that.value[i].id,id);
                if (""+that.newNodes[i].id == (id+"")) {
                    //console.log('pageData',that.value[i]);
                    return that.newNodes[i];
                }
            }
            return null;
        },
        completed  : function () {
            var that = this;
            PM = this;
            for (var i in that.value) {
                that.pagesType[that.value[i].id] = that.value[i].type;
            }
            jQuery('#jstree').jstree({
                "core" : {
                    "themes" : {
                        "variant" : "large"
                    },
                    "check_callback": true,
                    // 'data' : function (obj, callback) {
                    //     callback.call(this, that.value);
                    // },
                    // 'data' : that.value,
                    // 'data' : {
                    //     'url' : function (node) {
                    //         console.log('url',node);
                    //         return node.id === '#' ? '/foorm/cup_site_page' : '/static/3.3.10/assets/ajax_demo_children.json';
                    //     },
                    //     'data' : function (node) {
                    //         console.log('data ',node)
                    //         return {
                    //             'id' : node.id,
                    //             'text' : node.menu_it
                    //         };
                    //     }
                    // }
                },
                "types" : {
                    "#" : {
                        "max_children" : 100,
                        "max_depth" : 3,
                        "valid_children" : ["root"]
                    },
                    "root" : {
                        "icon" : "fa fa-globe",
                        "valid_children" : ["default"]
                    },
                    "default" : {
                        "icon" : "fa fa-folder",
                        "valid_children" : ["default","file"]
                    },
                    "file" : {
                        "icon" : "fa fa-file",
                        "valid_children" : []
                    },
                },
                "contextmenu":{
                    'items' : function(node) {
                        var items = $.jstree.defaults.contextmenu.items();
                        items.ccp = false;
                        if (node.id == 'root') {
                            delete items.remove;
                            delete items.rename;
                            delete items.remove;
                            return items;
                        }
                        var pageData = that.getPageData(node.id);
                        if (parseInt(pageData.fix) != 0)
                            return {};


                        //items.delete._disabled = true;

                        //items.create._disabled = (parseInt(pageData.fix) != 0);
                        //items.rename._disabled = (parseInt(pageData.fix) != 0);
                        items.create.icon = 'fa fa-plus';
                        items.rename.icon = 'fa fa-pencil';
                        items.remove.icon = 'fa fa-trash';
                        items.remove.separator_before = true;
                        // items.remove =  {
                        //     label: "Delete",
                        //     icon : 'fa fa-trash',
                        //     //_disabled : (parseInt(pageData.fix) != 0),
                        //     action: function() {
                        //         //console.log('nodeee',that.getPageData(node.id));
                        //         that.confirmDialog('Cancellare la pagina ' + pageData.menu_it,{
                        //             ok : function () {
                        //                 deleteNode(node);
                        //             }
                        //         })
                        //         // if ( confirm("Really delete " + pageData.menu_it + "?") ) {
                        //         //     deleteNode(node);
                        //         // }
                        //     },
                        //     separator_before: true
                        // }
                        console.log('items',items);
                        return items;
                    }
                },
                "plugins" : [
                    "contextmenu", "dnd", "search",
                    "types", "wholerow", "state"
                ]
            });
            jQuery('#jstree').on("changed.jstree", function (e, data) {
                var sel = data.selected;
                if (sel == 'root')
                    return ;
                if (Array.isArray(sel)) {
                    sel = sel[0];
                }
                console.log('sel',sel);
                if (!sel)
                    return ;
                that.showPage(parseInt(sel));
            });
            $('#jstree').on("create_node.jstree", function (e,data) {
                console.log('create node',e,data);
                var params = {
                    menu_it : data.node.text,
                    attivo : 1,
                    cup_site_page_id : data.parent=='root'?null:data.parent,
                };
                that.waitStart();
                that.savePage(null,params,function (json) {
                    that.waitEnd();
                    if (json.error) {
                        that.errorDialog(json.msg);
                        return ;
                    }
                    if (data.parent == 'root') {
                        console.log('create node root ',data.parent);
                        //that.value.push(json.result);
                        that.newNodes.push(json.result)
                    } else {
                        console.log('create node ',data.parent,pageData);
                        var pageData = that.getPageData(data.parent);

                        pageData.children.push(json.result);
                    }

                    jQuery('#jstree').jstree(true).set_id(data.node, json.result.id);
                });

            });
            $('#jstree').on("rename_node.jstree", function (e,data) {
                console.log('rename node',e,data);
                var pageData = that.getPageData(data.node.id)
                var params = {
                    menu_it : data.text,
                    titolo_it : pageData.titolo_it || data.text,
                };
                that.savePage(data.node.id,params);
            });
            $('#jstree').on("delete_node.jstree", function (e,data) {
                console.log('delete node',e,data);
                that.deletePage(data.node.id);
            });
            $('#jstree').on("dnd_stop.vakata", function (e,data) {
                console.log('dnd_stop',data);
                //that.deletePage(data.node.id);
            });
            $('#jstree').on("move_node.jstree", function (e,data) {
                console.log('dnd_stop2',data);
                that.updateParentPage(data.node.id,data.parent);
                //that.deletePage(data.node.id);
            });
            //that.showSetting();
        },
        createPage() {
            var that = this;
            var ref = $('#jstree').jstree(true);
            var sel = ref.get_selected();
            console.log('sel',sel)
            sel = sel[0];


            var r = that.createRoute('create');
            r.setValues({
                modelName : 'cup_site_page',
            });
            var params = {
                menu_it : 'new page' + Math.floor(Math.random()*100000),
                attivo : 1,
            };

            if (sel != 'root') {
                params['cup_site_page_id'] = sel;

            }
            r.setParams(params);

            Server.route(r,function (json) {
                if (json.error) {
                    that.errorDialog(json.msg);
                    return ;
                }
                var node = {
                    id : json.result.id,
                    text : json.result.menu_it
                };
                node.type = sel=='root'?'folder':'file';

                sel = ref.create_node(sel,node);
                console.log('nodo creato',sel,node);
            })
        },
        showPage(pk) {

            var that = this;
            if (that.currentPage) {
                that.currentPage.$destroy();
            }
            var htmlId = 'areaEdit';
            var pageData = that.getPageData(pk);
            console.log('page type',pk,that.getPageData(pk))
            var componente = new that.$options.components['c-site-page']({
                propsData : {
                    cConf : {
                        pk : pk,
                        type : pageData.type,
                        pageData : pageData
                    },
                },
                ref : 'site-page'
            });
            var id= 'd' + (new Date().getTime());
            jQuery('#'+htmlId).html('<div id="'+id+'" ></div>');
            componente.$mount('#'+id);
            that.currentPage = componente;





            // var that = this;
            // if (that.currentPage) {
            //     that.currentPage.$destroy();
            // }
            // var htmlId = 'areaEdit';
            // pageEdit.pk = pk;
            // var componente = new that.$options.components['v-edit']({
            //     propsData : {
            //         cConf : pageEdit,
            //     },
            //     ref : 'page'
            // });
            // var id= 'd' + (new Date().getTime());
            // jQuery('#'+htmlId).html('<div id="'+id+'" ></div>');
            // componente.$mount('#'+id);
            // that.currentPage = componente;
        },
        showSetting : function () {
            var that = this;
            if (that.settings) {
                that.settings.$destroy();
            }
            var htmlId = 'areaEdit';
            //settingsEdit.pk = pk;
            var componente = new that.$options.components['v-edit']({
                propsData : {
                    cConf : settingsEdit,
                },
                ref : 'setting'
            });
            var id= 'd' + (new Date().getTime());
            jQuery('#'+htmlId).html('<div id="'+id+'" ></div>');
            componente.$mount('#'+id);
            that.settings = componente;
        },
        deletePage(id) {
            var that = this;
            if (id == 'root')
                return ;
            var r = that.createRoute('delete');
            r.setValues({
                modelName : 'cup_site_page',
            });
            r.setParams({
                id : id,
            })
            Server.route(r,function (json){
                if (json.error) {
                    that.errorDialog(json.msg);
                    return ;
                }
                //that.reload();
            })
        },
        savePage(id,params,callback) {
            var that = this;
            var _cb = callback?callback:function (json) {
                if (json.error) {
                    that.errorDialog(json.msg);
                    return ;
                }
            }
            var r = id?that.createRoute('update'):that.createRoute('create');
            var values = {
                modelName : 'cup_site_page',
            };
            if (id)
                values.pk = id;
            r.setValues(values);
            r.setParams(params);
            Server.route(r,_cb);
        },
        updateParentPage : function (pageId,parentId) {
            var that = this;
            var params = {};
            params.cup_site_page_id = parentId;
            if (parentId == 'root') {
                params.cup_site_page_id = null;
            }
            that.savePage(pageId,params);
        }
    }
})
