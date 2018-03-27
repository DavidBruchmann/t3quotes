
plugin.tx_t3quotes_t3quotes {
  view {
    templateRootPaths.0 = EXT:t3quotes/Resources/Private/Themes/Default/Templates/
    templateRootPaths.1 = {$plugin.tx_t3quotes_t3quotes.view.templateRootPath}
    partialRootPaths.0 = EXT:t3quotes/Resources/Private/Themes/Default/Partials/
    partialRootPaths.1 = {$plugin.tx_t3quotes_t3quotes.view.partialRootPath}
    layoutRootPaths.0 = EXT:t3quotes/Resources/Private/Themes/Default/Layouts/
    layoutRootPaths.1 = {$plugin.tx_t3quotes_t3quotes.view.layoutRootPath}
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
}

plugin.tx_t3quotes._CSS_DEFAULT_STYLE (
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
