<?php

$tx_t3quotes_domain_model_t3quotes = [
    'ctrl' => [
        'title'	=> 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes',
        'label' => 'author_name',
        'label_alt' => 'author_title,quote',
        'label_alt_force' => TRUE,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
		'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'preface,quote,full_context,author_name,author_email,author_title,weight,date,selected,rotation_quote,authstate',
        'iconfile' => 'EXT:t3quotes/Resources/Public/Icons/tx_t3quotes_domain_model_t3quotes.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, preface, quote, full_context, author_name, author_email, author_title, weight, date, selected, rotation_quote, authstate',
    ],
    'types' => [
		'1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, preface, quote, full_context, author_name, author_email, author_title, weight, date, selected, rotation_quote, authstate, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
		'sys_language_uid' => [
			'exclude' => true,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'special' => 'languages',
				'items' => [
					[
						'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
						-1,
						'flags-multiple'
					]
				],
				'default' => 0,
			],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_t3quotes_domain_model_t3quotes',
                'foreign_table_where' => 'AND tx_t3quotes_domain_model_t3quotes.pid=###CURRENT_PID### AND tx_t3quotes_domain_model_t3quotes.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
		't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
		'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
		'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'l10n_display' => 'defaultAsReadonly',
			'l10n_mode' => 'exclude',
            'config' => [
                'type' => 'input',				  
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'l10n_display' => 'defaultAsReadonly',
			'l10n_mode' => 'exclude',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
        'preface' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.preface',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			]
	    ],
	    'quote' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.quote',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			]
	    ],
	    'full_context' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.full_context',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			]
	    ],
	    'author_name' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.author_name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'author_email' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.author_email',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'author_title' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.author_title',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'weight' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.weight',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'items' => [
			        // ['-- Label --', 0],
					Array("LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.weight.I.0", "100"),
					Array("LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.weight.I.1", "0"),
					Array("LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.weight.I.2", "-100"),
			    ],
			    'size' => 1,
			    'maxitems' => 1,
			    'eval' => ''
			],
	    ],
	    'date' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.date',
	        'config' => [
			    'dbType' => 'date',
			    'type' => 'input',
			    'size' => 7,
			    'eval' => 'date',
			    'default' => '0000-00-00'
			],
	    ],
	    'selected' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.selected',
	        'config' => [
			    'type' => 'check',
			    'items' => [
			        '1' => [
			            '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
			        ]
			    ],
			    'default' => 0
			]
	    ],
	    'rotation_quote' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.rotation_quote',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	    ],
	    'authstate' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:t3quotes/Resources/Private/Language/locallang_db.xlf:tx_t3quotes_domain_model_t3quotes.authstate',
	        'config' => [
			    'type' => 'check',
			    'items' => [
			        '1' => [
			            '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
			        ]
			    ],
			    'default' => 0
			]
	    ],
    ],
];

$t3Version = TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version( TYPO3_version );

// @see https://docs.typo3.org/typo3cms/extensions/core/Changelog/8.6/Breaking-79243-RemoveL10n_modeMergeIfNotBlank.html
// @see https://docs.typo3.org/typo3cms/extensions/core/Changelog/8.6/Deprecation-79440-TcaChanges.html
if(version_compare($t3Version, '8.6.0', '<')){
	$tx_t3quotes_domain_model_t3quotes['columns']['starttime']['l10n_mode'] = 'mergeIfNotBlank';
	$tx_t3quotes_domain_model_t3quotes['columns']['endtime']  ['l10n_mode'] = 'mergeIfNotBlank';
	# $tx_t3quotes_domain_model_t3quotes['columns']['date']     ['l10n_mode'] = 'mergeIfNotBlank';
}
else
{
	$tx_t3quotes_domain_model_t3quotes['columns']['starttime']['config']['behaviour']['allowLanguageSynchronization'] = true;
	$tx_t3quotes_domain_model_t3quotes['columns']['endtime']  ['config']['behaviour']['allowLanguageSynchronization'] = true;

	// @ see https://docs.typo3.org/typo3cms/extensions/core/Changelog/8.6/Deprecation-79440-TcaChanges.html#type-list
	$tmpStarttime = array(
		'config' => array(
			'type' => 'input',
			'renderType' => 'inputDateTime',
			'eval' => 'datetime',            // date | time | datetime | timesec
			'default' => 0,
			'range' => [
				'upper' => mktime(0, 0, 0, 1, 1, 2038)
			]
		),
		'exclude' => 1,
		'l10n_display' => 'defaultAsReadonly',
		'l10n_mode' => 'exclude',
		'label' => 'LLL:EXT:lang/Resources/Private/Language/locallang_general.xlf:LGL.starttime'
	);

	$tx_t3quotes_domain_model_t3quotes['columns']['starttime'] = $tmpStarttime;

	$tx_t3quotes_domain_model_t3quotes['columns']['endtime']  ['config']['renderType'] = 'inputDateTime';
	$tx_t3quotes_domain_model_t3quotes['columns']['endtime']  ['config']['eval']       = 'datetime';       // date | time | datetime | timesec

	$tx_t3quotes_domain_model_t3quotes['columns']['date']     ['config']['renderType'] = 'inputDateTime';
	$tx_t3quotes_domain_model_t3quotes['columns']['date']     ['config']['dbType']     = 'date';           // date | time | datetime | timesec
	$tx_t3quotes_domain_model_t3quotes['columns']['date']     ['config']['eval']       = 'date';           // date | time | datetime | timesec
}

return $tx_t3quotes_domain_model_t3quotes;
