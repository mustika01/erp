<?php

use Kumi\Jinzai\Models\PayoutItem;

return [

    'fields' => [

        'type' => [

            'label' => 'Type',

            'options' => [

                PayoutItem::TYPE_ADJUSTMENT => 'Adjustment',
                PayoutItem::TYPE_ATTENDANCE => 'Attendance',

            ],

        ],

        'description' => [
            'label' => 'Description',
        ],

        'days_count' => [
            'label' => 'No. of Days',
        ],

        'amount' => [
            'label' => 'Amount',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],

    ],

    'events' => [

        'created' => 'A new item has been created.',
        'updated' => 'The item\'s details has been updated.',
        'deleted' => 'The item has been deleted.',

    ],

    'actions' => [

        'adjustments' => [

            'create' => [

                'single' => [

                    'label' => 'New adjustment',

                    'modal' => [

                        'heading' => 'Create adjustment',

                        'actions' => [

                            'create' => [
                                'label' => 'Create',
                            ],

                        ],

                    ],

                    'messages' => [

                        'created' => 'Created',

                    ],

                ],

            ],

            'edit' => [

                'single' => [

                    'label' => 'Edit',

                    'modal' => [

                        'heading' => 'Edit adjustment',

                        'actions' => [

                            'save' => [
                                'label' => 'Save',
                            ],

                        ],

                    ],

                    'messages' => [

                        'saved' => 'Saved',

                    ],

                ],

            ],

            'delete' => [

                'single' => [

                    'label' => 'Delete',

                    'modal' => [

                        'heading' => 'Delete adjustment',

                        'actions' => [

                            'delete' => [
                                'label' => 'Delete',
                            ],

                        ],

                    ],

                    'messages' => [

                        'deleted' => 'Deleted',

                    ],

                ],

            ],

        ],

        'loans' => [

            'create' => [

                'single' => [

                    'label' => 'New loan',

                    'modal' => [

                        'heading' => 'Create loan',

                        'actions' => [

                            'create' => [
                                'label' => 'Create',
                            ],

                        ],

                    ],

                    'messages' => [

                        'created' => 'Created',

                    ],

                ],

            ],

            'edit' => [

                'single' => [

                    'label' => 'Edit',

                    'modal' => [

                        'heading' => 'Edit loan',

                        'actions' => [

                            'save' => [
                                'label' => 'Save',
                            ],

                        ],

                    ],

                    'messages' => [

                        'saved' => 'Saved',

                    ],

                ],

            ],

            'delete' => [

                'single' => [

                    'label' => 'Delete',

                    'modal' => [

                        'heading' => 'Delete loan',

                        'actions' => [

                            'delete' => [
                                'label' => 'Delete',
                            ],

                        ],

                    ],

                    'messages' => [

                        'deleted' => 'Deleted',

                    ],

                ],

            ],

        ],

    ],

];
