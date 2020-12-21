
var ModelCupSitePage = {
    search: {
        modelName : 'cup_site_page',
        //langContext : 'user',
        fields : ['nome_it'],
    },
    // view : {
    //     modelName : 'cup_geo_area',
    //     //fields : ['name','email','password','password_confirmation','banned','mainrole','fotos','attachments'],
    //     actions : [],
    //     fieldsConfig : {
    //         mainrole : {
    //             type : 'w-belongsto',
    //             fields : ['name']
    //         }
    //     }
    // },
    list: {
        modelName : 'cup_site_page',
        fields : ['codice','nome_it','attivo'],
        actions : ['action-edit','action-delete','action-insert','action-anteprima',
            'action-export-csv'
        ],
        orderFields : {
            'codice':'codice',
            'nome_it':'nome_it'
        },
        fieldsConfig : {
            'attivo' : {
                type : 'w-swap-smarty',
                modelName : 'cup_geo_area'
            }
        },
        customActions : {
            'action-export-csv' : {
                text: 'Csv',
            }
        }
    },
    edit: {
        modelName : 'cup_site_page',
        actions : ['action-save'],
        fields : ['menu_it','titolo_it','content_it','keywords','attivo','cup_site_page_id'],
        fieldsConfig : {
            cup_site_page_id : 'w-hidden',
            content_it : {
                type : 'w-texthtml',
                template : 'tpl-no'
            },
            keywords : {
                type: 'w-textarea',
                template: 'tpl-full-no'
            },
            attivo : {
                type : 'w-radio',
                domainValues : {
                    0 : 'non attivo',
                    1 : 'attivo'
                }
            }
        }
    },
    home : {
        modelName : 'cup_site_page',
        actions : ['action-save'],
        fields : ['content_it','keywords'],
        fieldsConfig : {
            content_it : {
                type : 'w-textarea',
                template : 'tpl-no'
            },
            keywords : {
                type: 'w-textarea',
                template: 'tpl-no'
            }
        }
    }
}

