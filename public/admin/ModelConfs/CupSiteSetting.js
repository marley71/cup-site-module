var ModelCupSiteSetting = {
    edit : {
        modelName : 'cup_site_setting',
        fieldsConfig : {
            logo : {
                type: "w-upload-ajax",
                extensions: ['pdf'],
                maxFileSize: '5M',
                ajaxFields: {
                    field: 'logo',
                    resource_type: 'foto'
                },
                foormType: 'edit',
                modelName: 'cup_site_setting',
                template: "tpl-full-no",
            }
        }
    }

}
