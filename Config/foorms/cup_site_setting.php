<?php


return [

    'search' => [
        "fields" => [
            "titolo_it" => [
                'operator' => 'like',
            ]
        ],

    ],
    'list' => [

////        'allowed_actions' => [
////            'csv-export' => true,
////        ],
//
        'actions' => [
            'set' => [
                'allowed_fields' => [
                    'attivo',
                ],
            ],
            //            'csv-export' => [
//                'default' => [
//                    'blacklist' => [
////                        'password'
//                    ],
//                    'whitelist' => [
//                        "codice",
//                        "nome_it",
//
//                ],
//                    'fieldsParams' => [
////                        "istituto|comunenome" => [
////                            'header' => 'Istituto - comune (nome)',
////                            'item' => 'istituto|T_COMUNE_ID',
////                        ],
//                    ],
//                    'separator' => ';',
//                    'endline' => "\n",
//                    'headers' => 'translate',
//                    'decimalFrom' => '.',
//                    'decimalTo' => false,
//                ],
//            ]
//
        ],

        'dependencies' => [
            'search' => 'search',
        ],

        'pagination' => [
            //'per_page' => 20,
            'pagination_steps' => [10, 20, 50],
        ],

        'fields' => [
            "id" => [

            ],
            "titolo_it" => [

            ],
            'attivo' => [

            ],
        ],
        'relations' => [

        ],
        'params' => [

        ],
    ],


    'edit' => [
        'actions' => [
            'uploadfile' => [
                'allowed_fields' => [
                    'logo',
                ],
                'fields' => [
                    'logo' => [
                        'resource_type' => 'foto',
                        //'max_size' => '4M',
                        //'exts' => 'jpg,png',
                    ],
                ],
            ],

        ],
        'fields' => [
            'id' => [

            ],
            "logo" => [

            ],
            "properties" => [

            ],
            "default_properties" => [

            ],
            "attivo" => [

            ]
        ],
        'relations' => [

        ],
        'params' => [

        ],
    ],
//    'insert' => [
//
//    ],

];
