
## #####################################################################
## T3quotes Simple Theme
## =====================
## while the setup is a bit more complicated, usage is easier
## because in the constant editor only the theme and the general
## themes-path have to be adjusted in plugin.tx_t3quotes_t3quotes.view
## #####################################################################

plugin.tx_t3quotes_t3quotes {
  view {    
    templateRootPaths.0 = EXT:t3quotes/Resources/Private/Themes/Default/Templates/
    templateRootPaths.1 = COA
    templateRootPaths.1 {
		10 = TEXT
		10.value = {$plugin.tx_t3quotes_t3quotes.view.themesPath}
		20 = TEXT
		20.value = {$plugin.tx_t3quotes_t3quotes.view.theme}
		# 20.wrap = /|
		30 = TEXT
		30.value = /Templates
	}
    partialRootPaths.0 = EXT:t3quotes/Resources/Private/Themes/Default/Partials/
    partialRootPaths.1 = COA
    partialRootPaths.1 {
		10 = TEXT
		10.value = {$plugin.tx_t3quotes_t3quotes.view.themesPath}
		20 = TEXT
		20.value = {$plugin.tx_t3quotes_t3quotes.view.theme}
		# 20.wrap = /|
		30 = TEXT
		30.value = /Partials
	}
    layoutRootPaths.0 = EXT:t3quotes/Resources/Private/Themes/Default/Layouts/
    layoutRootPaths.1 = COA
    layoutRootPaths.1 {
		10 = TEXT
		10.value = {$plugin.tx_t3quotes_t3quotes.view.themesPath}
		20 = TEXT
		20.value = {$plugin.tx_t3quotes_t3quotes.view.theme}
		# 20.wrap = /|
		30 = TEXT
		30.value = /Layouts
	}
  }
  persistence {
    storagePid = {$plugin.tx_t3quotes_t3quotes.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
  settings {
	formatDate = {$plugin.tx_t3quotes_t3quotes.settings.formatDate}
	feFormEnabled = {$plugin.tx_t3quotes_t3quotes.settings.feFormEnabled}
	disableDetailView = {$plugin.tx_t3quotes_t3quotes.settings.disableDetailView}
  }
}

# [globalVar = LIT:1 = {$constant_to_turnSomethingOn}]

#	plugin.tx_t3quotes_t3quotes.view {
#		templateRootPaths.1.dataWrap = {$plugin.tx_t3quotes_t3quotes.themesPath}
#	}



## #####################################################################
##                    STYLES FOR TEMPLATES
## For each template the included style is limited to the required
## rules. With the current setup below no CSS for unused templates will
## be included.
## #####################################################################



[globalVar = LIT:Classic = {$plugin.tx_t3quotes_t3quotes.view.theme}]

## #####################################################################
##                  STYLE FOR CLASSIC TEMPLATE
## A few additional rules have been added to the classic style.
## The outer container was not styled at all and consists now of border
## padding and maximal width.
## Some further rules are added but marked in the stylesheet below as
## "additional". So the classic style was quite rudimentary.
## The rules below will be merged in the general CSS for the whole
## website, depending on the choice of the theme in constant editor.
## #####################################################################

plugin.tx_t3quotes._CSS_DEFAULT_STYLE (
	/* rules for .tx-t3quotes-pi1 are additional */
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic {
		max-width:400px;
		margin:0 auto;
		overflow:hidden;
		padding:1em;
		border:2px solid #eee;
		border-radius:6px;
		padding-top:calc(0.5em - 2px);
	}
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic .tx-t3quotes-pi1-listrow P.tx-t3quotes-pi1-listrowField-quote {
		font-style: italic;
		margin-left: 50px;
	}
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic h2.tx-t3quotes-pi1-listrowField-quote {
		font-style: italic;
		font-size:28px;
		text-align:center;
		margin-bottom:50px;
	}
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic p.tx-t3quotes-pi1-listrowField-author {
		background-color: #eeeeee;
		margin-top: 10px;
		
		/* following rules are additional */
		padding:.5em;
		/*
		border-radius:4px 4px 0 0 ;
		border:1px solid #dadada;
		border-width:1px 1px 0 1px;
		*/
	}
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic p.tx-t3quotes-pi1-listrowField-preface {
		font-style: italic;
		margin-left: 50px;
		color: maroon;
		
		/* following rules are additional */
		font-size:smaller;
		color: rgba(128,0,0,0.5);
	}
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic p.tx-t3quotes-pi1-listrowField-fullContext {
		font-style: italic;
		margin-left: 50px;
		color: #000;
		
		/* following rules are additional */
		font-size:smaller;
	}
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic p.tx-t3quotes-pi1-listrowField-preface,
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic p.tx-t3quotes-pi1-listrowField-fullContext {
		margin-left: 0px;
	}
	
	/** ****************************************************************
	 *             ALL following CSS rules are additional
	 ** ****************************************************************
	 */
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic .tx-t3quotes-pi1-listrow P.tx-t3quotes-pi1-listrowField-preface:focus,
	.tx-t3quotes-pi1.tx-t3quotes-theme-classic .tx-t3quotes-pi1-listrow P.tx-t3quotes-pi1-listrowField-preface:hover {
		color: rgba(128,0,0,1);
	 }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic .tx-t3quotes-pi1-link hr {
		border:0;
		height:2px;
		background-color:#eee;
		display:block;
		margin-top:25px;
    }
    
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic form {
		display:block;
		width:100%;
		overflow:hidden;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic textarea,
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic input[type=text],
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic input[type=radio],
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic input[type=checkbox],
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic select {
		margin-bottom:1em;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic textarea,
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic input[type=text] {
		width: calc(100% - 8px);
		border:2px solid #ddd;
		border-radius:2px;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic textarea:focus,
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic input[type=text]:focus {
		background:#eee;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic textarea {
		height:100px !important;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic .submit-container {
		text-align:center;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic a.full-listitem-link {
		color:#000;
		text-decoration:none;
		display:block;
		width:100%;
		overflow:hidden;
		background:transparent;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic a.full-listitem-link:hover,
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic a.full-listitem-link:focus {
		background:#eee;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic a.full-listitem-link:hover p.tx-t3quotes-pi1-listrowField-author,
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic a.full-listitem-link:focus p.tx-t3quotes-pi1-listrowField-author {
		background:#ccc !important;
    }
    .tx-t3quotes-pi1-link {
		/* is container for link */
		text-align:center;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic .linkButton {
		display:inline-block;
		padding:0.2em 0.5em;
		background:#e0e0e0;
		border:1px solid #ddd;
		border-radius:4px;
		text-decoration:none;
		color:#000;
		margin:0.5em auto 0 auto;
    }
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic .linkButton:hover,
    .tx-t3quotes-pi1.tx-t3quotes-theme-classic .linkButton:focus {
		background:#d0d0d0;
		border:1px solid #ccc;
		color:#000;
	}
    
    
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-t3quotes table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-t3quotes table th {
        font-weight:bold;
    }

    .tx-t3quotes table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)

[GLOBAL]
