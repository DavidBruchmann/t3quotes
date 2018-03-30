##
## plugin.tx_t3quotes_t3quotes
## Available themes: Default, Bootstrap, Classic, Development
##
plugin.tx_t3quotes_t3quotes {
  view {
    theme = Classic
    # cat=plugin.tx_t3quotes_t3quotes/file; type=string; label=Path to the themes (FE)
    themesPath = EXT:t3quotes/Resources/Private/Themes/
  }
  persistence {
    # cat=plugin.tx_t3quotes_t3quotes//a; type=string; label=Default storage PID
    storagePid =
  }
  settings {
    formatDate = Y-m-d
    feFormEnabled = 1
    disableDetailView = 0
  }
}
