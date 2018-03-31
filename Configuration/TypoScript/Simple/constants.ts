##
## plugin.tx_t3quotes_t3quotes
## Available themes: Default, Bootstrap, Classic, Development
##
plugin.tx_t3quotes_t3quotes {
  view {
    theme = Classic
    # cat=plugin.tx_t3quotes_t3quotes/file; type=string; label=LLL:EXT:t3quotes/Resources/Private/Language/locallang.xlf:tx_t3quotes_domain_model_t3quotes.view.pathToThemesFE
    themesPath = EXT:t3quotes/Resources/Private/Themes/
  }
  persistence {
    # cat=plugin.tx_t3quotes_t3quotes//a; type=string; label=LLL:EXT:t3quotes/Resources/Private/Language/locallang.xlf:tx_t3quotes_domain_model_t3quotes.persistence.defaultStoragePid
    storagePid =
  }
  settings {
	# cat=plugin.tx_t3quotes_t3quotes//a; type=string; label=LLL:EXT:t3quotes/Resources/Private/Language/locallang.xlf:tx_t3quotes_domain_model_t3quotes.settings.formatDate
    formatDate = Y-m-d
	# cat=plugin.tx_t3quotes_t3quotes//a; type=boolean; label=LLL:EXT:t3quotes/Resources/Private/Language/locallang.xlf:tx_t3quotes_domain_model_t3quotes.settings.feFormEnabled
    feFormEnabled = 1
	# cat=plugin.tx_t3quotes_t3quotes//a; type=boolean; label=LLL:EXT:t3quotes/Resources/Private/Language/locallang.xlf:tx_t3quotes_domain_model_t3quotes.settings.disableDetailView
    disableDetailView = 0
  }
}
